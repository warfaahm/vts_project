<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreAdminRequest;
use App\Models\Admin;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function register(StoreAdminRequest $request)
    {
        $request->validated($request->all());

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return $this->success([
            'user' => $admin,
            'message' => 'Admin added successfully!',
        ]);
    }

    public function index()
    {
        $admin = Admin::all();
        return $this->success($admin);
    }

    public function show($id)
    {
        $admin = Admin::find($id);

        if (!$admin){
            return response()->json([
                'success' => false,
                'message' => 'Admin User not found',
            ], 404);
        }

        return $this->success($admin);
    }

    public function destroy(Admin $admin)
    {
        if ($admin->id == 1 || $admin->id == 2 || Auth::user()->id == $admin->id){
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        $admin->delete();
        return response(null, 204);
    }
}
