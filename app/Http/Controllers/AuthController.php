<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\TokenService;
use App\Services\UserService;
use App\Traits\APIResponses;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use APIResponses;

    protected $userService;
    protected $tokenService;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserService $userService, TokenService $tokenService)
    {
        $this->userService = $userService;
        $this->tokenService = $tokenService;
        $this->middleware('auth:api', ['except' => ['login', 'register', 'verify']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token =  auth('api')->attempt($credentials)) {
            return $this->unauthorized(['error' => 'Unauthorized']);
        }

        return $this->respondWithToken($token);
    }

    public function register(RegisterRequest $request)
    {
        $userData = $request->validated();
        $user = $this->userService->create($userData);
        $token = $this->tokenService->create($user);

        return $this->ok([
            'message' => 'User successfully registered',
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->ok([
            'user' => auth()->user()
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return $this->ok([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->tokenService->refresh());
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
        return $this->ok([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->tokenService->expiration(),
        ]);
    }

    public function verify(Request $request)
    {
        $token = $request->header('authorization');
        $jwt = trim(trim($token, 'Bearer'));

        $error = [
            'error' => 'Unauthorized'
        ];

        try {
            $this->tokenService->verify($jwt);
        } catch (\Exception $e) {
            return $this->unauthorized($error);
        }

        return $this->ok([
            'message' => 'Token is valid'
        ]);
    }
}
