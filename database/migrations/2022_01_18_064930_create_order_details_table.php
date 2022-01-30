<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->longText('variation')->nullable();
            $table->double('price',20,2)->nullable();
            $table->double('tax',20,2)->default(0.00);
            $table->double('shipping_cost',20,2)->default(0.00);
            $table->integer('quantity')->nullable();
            $table->string('payment_status')->default('unpaid');
            $table->string('delivery_status')->default('pending');
            $table->string('shipping_type')->nullable();
            $table->integer('pickup_point_id')->nullable();
            $table->string('product_referral_code')->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
