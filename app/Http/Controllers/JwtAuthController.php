<?php

namespace App\Http\Controllers;

use App\Modules\Customers\Services\CustomerService;
use Illuminate\Http\Request;

class JwtAuthController extends ApiServiceController
{
    public function __construct(CustomerService $service)
    {
        $this->service = $service;
    }

    public function register(Request $request)
    {
        $this->create($request);
    }

    public function login(Request $request)
    {
        $this->service->login($request);
    }

    public function profile()
    {

        $userdata = auth()->user();

        return response()->json([
            "status" => true,
            "message" => "Profile data",
            "data" => $userdata
        ]);
    }

    public function refreshToken()
    {

        $token = auth()->refresh();

        return response()->json([
            "status" => true,
            "message" => "New access token",
            "token" => $token
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            "status" => true,
            "message" => "User logged out successfully"
        ]);
    }
}
