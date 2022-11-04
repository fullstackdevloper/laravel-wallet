<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('product_id')->default(0);
            $table->integer('quantity')->default(0);
            $table->float('amount')->default(0);
            $table->float('total_amount')->default(0);
            $table->float('old_user_balance')->default(0);
            $table->float('new_user_balance')->default(0);
            $table->enum('transaction_type', ['add_money', 'purchase_order','refund']);
            $table->enum('transaction_status', ['Pending', 'Success','Failed','Cancelled']);
            $table->dateTime('transaction_date', $precision = 0);
            $table->timestamps();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet');
    }
};
