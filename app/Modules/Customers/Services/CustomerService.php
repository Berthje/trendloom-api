<?php

namespace App\Modules\Customers\Services;

use App\Models\Customer;
use App\Modules\Core\Services\Service;
use Tymon\JWTAuth\Facades\JWTAuth;
use Nette\Utils\Random;
use App\Contracts\IsAllowed;
use Illuminate\Auth\Access\AuthorizationException;

class CustomerService extends Service implements IsAllowed
{
    protected $fields = ['first_name', 'last_name', 'email', 'phone_number', 'password', 'address_id'];
    protected $searchField = 'customer';
    protected $rules = [
        "add" => [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'phone_number' => 'required|string',
            'password' => 'required|string|min:6',
            'preferred_locale' => 'sometimes|string|default:en',
        ],
        "update" => [
            'first_name' => 'sometimes|string',
            'last_name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:customers,email',
            'phone_number' => 'sometimes|string',
            'password' => 'sometimes|string|min:6',
            'address_id' => 'sometimes|exists:addresses,id',
            'preferred_locale' => 'sometimes|string'
        ],
        "delete" => [
            'id' => 'required|exists:customers,id',
        ],
        "get" => [
            'id' => 'required|exists:customers,id',
        ],
        "login" => [
            'email' => 'required|email',
            'password' => 'required'
        ]
    ];

    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }

    protected function getRelationFields()
    {
        return [
            'addresses:id,address,city,state,zip,country'
        ];
    }

    public function getAddressesByCustomerId($customerId)
    {
        return $this->model->find($customerId)->addresses;
    }

    public function login($data)
    {
        $this->validate($data->all(), "login");

        $csrfLength = env("CSRF_TOKEN_LENGTH");
        $csrfToken = Random::generate($csrfLength);

        $token = JWTAuth::claims(['X-XSRF-TOKEN' => $csrfToken])->attempt([
            "email" => $data->email,
            "password" => $data->password
        ]);

        return [
            'token' => $token,
            'csrfToken' => $csrfToken
        ];
    }

    public function isAllowed(int $customerEntityId, int $userId): bool
    {
        $user = Customer::find($userId);

        return $customerEntityId === $userId || $user->isAdmin();
    }

    public function get($id, $ruleKey = "get") {
        $this->validate(['id' => $id], $ruleKey);

        if ($this->hasErrors()) {
            return;
        }

        if (!$this->isAllowed($id, auth('api')->user()->id)) {
            throw new AuthorizationException('Unauthorized');
        }

        return $this->model->with($this->getRelationFields())->find($id);
    }

    public function update($id, $data, $ruleKey = "update") {
        $this->validate($data, $ruleKey);

        if ($this->hasErrors()) {
            return;
        }

        if (!$this->isAllowed($id, auth('api')->user()->id)) {
            throw new AuthorizationException('Unauthorized');
        }

        return $this->model->where('id', $id)->update($data);
    }

    public function delete($id, $ruleKey = "delete") {
        $this->validate(['id' => $id], $ruleKey);

        if ($this->hasErrors()) {
            return;
        }

        if (!$this->isAllowed($id, auth('api')->user()->id)) {
            throw new AuthorizationException('Unauthorized');
        }

        return $this->model->where('id', $id)->delete();
    }
}
