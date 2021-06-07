<?php

namespace App\Http\Controllers;

use App\Exceptions\HttpExceptions\UnprocessibleEntityException;
use App\Http\Controllers\Requests\User\UserRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use  App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth', ['except' => ['login', 'register']]);
    }

    /**
     * Store a new user.
     *
     * @param UserRegisterRequest $userRegisterRequest
     * @return JsonResponse
     */
    public function register(UserRegisterRequest $userRegisterRequest)
    {
        try {

            $user = new User;
            $user->name = $userRegisterRequest->request->input('name');
            $user->email = $userRegisterRequest->request->input('email');
            $plainPassword = $userRegisterRequest->request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();

            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        } catch (UnprocessibleEntityException $e) {
            return response()->json(['errors' => $e->getMessage()], 409);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }

    }

    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
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
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }


}
