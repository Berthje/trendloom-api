<?php

namespace App\Modules\Customers\Services;

use App\Models\Customer;
use Tymon\JWTAuth\Facades\JWTAuth;
use Nette\Utils\Random;
use Illuminate\Auth\Access\AuthorizationException;
use App\Modules\Core\Services\AuthenticatedService;
use Illuminate\Http\Request;

class CustomerService extends AuthenticatedService
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

    public function isAllowed(int $entityCustomerId, int $userId): bool
    {
        $user = Customer::find($userId);

        return $entityCustomerId === $userId || $user->isAdmin();
    }

    protected function getRelationFields()
    {
        return [
            'addresses:id,address,city,state,zip,country'
        ];
    }

    public function get($id, $ruleKey = "get") {
        return $this->performAction($id, ['id' => $id], $ruleKey, 'find');
    }

    public function update($id, $data, $ruleKey = "update") {
        return $this->performAction($id, $data, $ruleKey, 'update');
    }

    public function delete($id, $ruleKey = "delete") {
        return $this->performAction($id, ['id' => $id], $ruleKey, 'delete');
    }

    public function login(Request $data) {
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

    public function getAddressesByCustomerId($customerId) {
        if (!$this->isAllowed($customerId, auth('api')->user()->id)) {
            throw new AuthorizationException('Unauthorized');
        }

        return $this->model->find($customerId)->addresses;
    }
}
