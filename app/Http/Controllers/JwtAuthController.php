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
        return $this->create($request);
    }

    public function login(Request $request)
    {
        $token = $this->service->login($request);

        if(empty($token)){
            return response()->json([
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
