<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Buyers\LoginRequest;
use Facades\App\Services\SellerAuthService;
use App\Traits\HasApiResponse;

class AuthController extends Controller
{
    use HasApiResponse;

    public function login(LoginRequest $request)
    {
        $credentials = request(["email", "password"]);

        $authData = SellerAuthService::login($credentials, $request);

        return $authData
            ? $this->apiSuccess($authData)
            : $this->apiError(
                __("These credentials do not match our records."),
                401
            );
    }

    public function logout()
    {
        request()
            ->user()
            ->token()
            ->revoke();
        return $this->apiSuccess([
            "message" => __("Logout Successful."),
        ]);
    }

    public function authUser()
    {
        return $this->apiSuccess(\request()->user());
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = $request->user();
        $user->update([
            "password" => $request->password,
        ]);

        return $this->apiUpdated(true);
    }
}
