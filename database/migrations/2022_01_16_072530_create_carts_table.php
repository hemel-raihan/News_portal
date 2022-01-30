<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('temp_user_id')->nullable();
            $table->integer('address_id')->nullable();
            $table->integer('product_id');
            $table->text('variation')->nullable();
            $table->double('price',20,2)->nullable();
            $table->double('tax',20,2)->nullable();
            $table->double('shipping_cost',20,2)->nullable();
            $table->string('shipping_type',30)->nullable();
            $table->integer('pickup_point')->nullable();
            $table->double('discount',10,2)->nullable();
            $table->string('product_referral_code')->nullable();
            $table->string('coupon_code')->nullable();
            $table->tinyInteger('coupon_applied')->nullable();
            $table->integer('quantity');
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
        Schema::dropIfExists('carts');
    }
}
