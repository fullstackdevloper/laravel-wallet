<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\LoginUserRequest;
use App\Http\Resources\Users\TokenResource;
use App\Exceptions\UserNotFoundException;
class AuthController extends BaseController
{

    
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginUserRequest $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];


        try{
        if (auth()->attempt($data))
        {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            $user = auth()->user();
            $user->token = $token;
            return new TokenResource($user);
        } else {
            throw new UserNotFoundException('User not found or password mismatched',404);
        }

    }catch (UserNotFoundException $e) {
        \Log::debug($e->getMessage());
         return response()->json([
            'error' => $e->getMessage()], 404);
    }
    
}
}
