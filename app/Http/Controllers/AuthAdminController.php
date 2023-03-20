<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Models\Admin;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{

    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        if (!Auth::guard('admin')->attempt(['email' => request('email'), 'password' => request('password')])){
            return $this->error('', 'Credentials do not match', 401);
        }

        $admin = Admin::where('email', $request->email)->first();

        return $this->success([
            'user' => $admin,
            'token' => $admin->createToken('API Token of ' . $admin->name)->plainTextToken,
        ]);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->success([
            'message' => 'You has successfully logged out',
        ]);
    }
}
