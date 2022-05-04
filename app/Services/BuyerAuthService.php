<?php

namespace App\Services;

use App\Models\Buyer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BuyerAuthService
{
    public function login($credentials)
    {
        $user = Buyer::whereEmail($credentials["email"])->first();

        if ($user && Hash::check($credentials["password"], $user->password)) {
            $tokenResult = $user->createToken(config("app.name"));
            $token = $tokenResult->plainTextToken;

            return [
                "access_token" => $token,
                "token_type" => "Bearer",
                "user" => $user,
            ];
        }

        return false;
    }
}
