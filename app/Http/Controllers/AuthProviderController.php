<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Resources\ProviderResource;
use App\Models\Admin;
use App\Models\Healthcare_provider;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthProviderController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        if (!Auth::guard('healthcare_provider')->attempt(['email' => request('email'), 'password' => request('password')])){
            return $this->error('', 'Credentials do not match', 401);
        }

        $user = Healthcare_provider::where('email', $request->email)->first();

        return $this->success([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken,
        ]);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->success([
            'message' => 'You has successfully logged out',

        ]);
    }

    public function register(StoreProviderRequest $request)
    {
        $request->validated($request->all());

        $provider = Healthcare_provider::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'hospital_id' => $request->hospital_id,
        ]);

        return $this->success([
            'user' => $provider,
            'message' => 'Provider - added successfully!',
        ]);
    }

    public function registerProvider(StoreProviderRequest $request)
    {
        $request->validated($request->all());

        $provider = Healthcare_provider::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'hospital_id' => Auth::user()->hospital_id,
        ]);

        return $this->success([
            'user' => $provider,
            'message' => 'Provider - added successfully!',
        ]);
    }

    public function indexProvider()
    {
        // $data = Healthcare_provider::where('hospital_id', Auth::user()->hospital_id)->orderBy('name')->get();

        $data = ProviderResource::collection(
            Healthcare_provider::where('hospital_id', Auth::user()->hospital_id)->orderBy('name')->get()
        );

        return $this->success($data);
    }

    public function index()
    {
        // $data = Healthcare_provider::where('role', 'admin')->get();

        $data = ProviderResource::collection(
            Healthcare_provider::where('role', 'admin')->orderBy('name')->get()
        );

        return $this->success($data);
    }

    public function showProvider(Healthcare_provider $provider)
    {
        if (Auth::user()->hospital_id !== $provider->hospital_id){
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        $data = new ProviderResource($provider);
        return $this->success($data);
    }

    public function show(Healthcare_provider $provider)
    {
        if ($provider->role !== 'admin')
        {
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        $data = new ProviderResource($provider);
        return $this->success($data);
    }

    public function destroy(Healthcare_provider $provider)
    {
        if (Auth::user()->hospital_id !== $provider->hospital_id && $provider->role == 'admin'){
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        $provider->delete();
        return response(null, 204);
    }
}
