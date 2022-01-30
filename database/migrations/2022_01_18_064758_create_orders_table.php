<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('combined_order_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('guest_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->longText('shipping_address')->nullable();
            $table->string('delivery_status')->default('pending');
            $table->string('payment_type')->nullable();
            $table->string('payment_status')->default('unpaid');
            $table->longText('payment_details')->nullable();
            $table->double('grand_total',20,2)->nullable();
            $table->double('coupon_discount')->default(0.00);
            $table->mediumText('code')->nullable();
            $table->string('tracking_code')->nullable();
            $table->integer('date')->nullable();
            $table->integer('viewed')->default(0);
            $table->integer('delivery_viewed')->default(1);
            $table->integer('payment_status_viewed')->default(1);
            $table->integer('commission_calculated')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
