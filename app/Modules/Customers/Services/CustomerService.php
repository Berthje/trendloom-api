<?php

namespace App\Modules\Customers\Services;

use App\Models\Customer;
use App\Modules\Core\Services\Service;
use Tymon\JWTAuth\Facades\JWTAuth;
use Nette\Utils\Random;

class CustomerService extends Service
{
    protected $fields = ['first_name', 'last_name', 'email', 'phone_number', 'password', 'address_id'];
    protected $searchField = 'customer';
    protected $rules = [
        "add" => [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'phone_number' => 'required|string',
            'password' => 'required|string|min:6'
        ],
        "update" => [
            'first_name' => 'sometimes|string',
            'last_name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:customers,email',
            'phone_number' => 'sometimes|string',
            'password' => 'sometimes|string|min:6',
            'address_id' => 'sometimes|exists:addresses,id'
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

    public function login($request)
    {
        $request->validate($request->all(), "login");

        $csrfLength = env("CSRF_TOKEN_LENGTH");
        $csrfToken = Random::generate($csrfLength);

        $token = JWTAuth::claims(['X-XSRF-TOKEN' => $csrfToken])->attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        if(empty($token)){
            return response()
            ->json([
                "status" => false,
                "message" => "Invalid details"
            ]);
        }

        $ttl = env("JWT_COOKIE_TTL");
        $tokenCookie = cookie("token", $token, $ttl);
        $csrfCookie = cookie("X-XSRF-TOKEN", $csrfToken, $ttl);

        return response(["message" => "Customer logged in succcessfully"])
        ->withCookie($tokenCookie)
        ->withCookie($csrfCookie);
    }
}
