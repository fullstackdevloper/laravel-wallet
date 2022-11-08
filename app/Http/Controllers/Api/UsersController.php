<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\AddMoneyRequest;
use App\Http\Requests\API\BuyCookieRequest;
use App\Http\Resources\Users\UserResource;

class UsersController extends BaseController
{

    
    /**
     * Add Money To Wallet api
     *
     */
    public function addMoneyToWallet(AddMoneyRequest $request)
    {
        $user = auth()->user();
        $user->wallet = $user->wallet+$request->amount;
        $user->save();
        return new UserResource($user);
    }

    /**
     * Buy Cookie api
     *
     */

    public function buyCookie(BuyCookieRequest $request)
    {
        $selectedCookiesCounts = count($request->get('cookies'));
        $user = auth()->user();
        $user->wallet = $user->wallet-$selectedCookiesCounts*1;
        $user->save();
        return new UserResource($user);
    }
}