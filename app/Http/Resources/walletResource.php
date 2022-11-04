<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class walletResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'transaction_type' => $this->transaction_type,
            'transaction_status' => $this->transaction_status,
            'transaction_date' => $this->transaction_date,
            'amount' => $this->amount,
            'total_amount' => $this->total_amount,
            'old_user_balance' => $this->old_user_balance,
            'new_user_balance' => $this->new_user_balance,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
