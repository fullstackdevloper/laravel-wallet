<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Products;
use App\Http\Resources\walletResource;
use App\Http\Requests\CartRequest;
use Illuminate\Support\Facades\Auth;
use Validator;
use Carbon\Carbon;

class productController extends BaseController
{

    public function checkout(CartRequest $request)
    {
        $user = auth()->user();
        $input = $request->all();

        if (Products::where('id', '=', $input['product_id'])->count() == 0)
        {
            return $this->sendResponse('', 'Product not Found,Something Went Wrong!!');
        } else
        {

            $Product = Products::find($input['product_id']);
            $input['amount'] = $Product['price'];
            $input['transaction_type'] = 'purchase_order';
            $input['total_amount'] = $Product['price'] * $input['qty'];
            $input['quantity'] = $input['qty'];
            $input['old_user_balance'] = $user->wallet_balance;
            $input['new_user_balance'] = $user->wallet_balance - $input['total_amount'];
            $input['transaction_status'] = 'Success';
            $input['transaction_date'] = Carbon::now();

            if (User::where('id', '=', $input['user_id'])->count() == 0)
            {
                return $this->sendError('User Does not exists', 404);
            } else
            {
                $user1 = User::find($input['user_id']);

                if ($user1['wallet_balance'] >= $input['total_amount'])
                {

                    $wallet = Wallet::create($input);
                    $userData['wallet_balance'] = $wallet['new_user_balance'];
                    $user->wallet_balance = $wallet['new_user_balance'];
                    $user = $user->save();

                    return $this->sendResponse(new walletResource($wallet), 'Order Placed successfully');
                } else
                {
                    return $this->sendError('Wallet balance is not enough', 404);
                }
            }
        }
    }

}
