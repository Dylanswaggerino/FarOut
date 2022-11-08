<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['status' => false, 'error' => 'Unauthorized.'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the token array structure.
     *
     * @param  RegisterUserRequest $request
     * @param  User $user
     *
     * @return JsonResponse
     */
    public function register(RegisterUserRequest $request, User $user): JsonResponse
    {
        $user = $user->create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'address' => $request->get('address'),
            'postal_code' => $request->get('postal_code'),
            'city' => $request->get('city'),
            'country_code' => $request->get('country_code'),
            'phone' => $request->get('phone'),
        ]);

        // if (!$user = $user->create($request->safe()->all())) {
        //     return response()->json(["status" => false, "response" => "Something went wrong while trying to create a new user account."], 400);
        // }

        return response()->json(["status" => true, "response" => $user], 201);
    }

    public function checkToken() {
        return response()->json(["success" => true], 200);
    }

    public function isEmployee() {
        if (!auth()->user()->is_employee) {
            return response()->json(["status" => false, "response" => "User is not an employee."], 200);
        }

        return response()->json(["status" => true], 200);
    }
}
