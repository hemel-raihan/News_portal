<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->default(2);
            $table->integer('referred_by')->nullable();
            $table->string('provider_by')->nullable();
            $table->string('user_type')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('verificaton_code')->nullable();
            $table->text('new_email_verificaton_code')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('avatar')->nullable();
            $table->string('avatar_original')->nullable();
            $table->text('address')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone')->nullable();
            $table->double('balance',20,2)->nullable();
            $table->tinyInteger('banned')->nullable();
            $table->string('referral_code')->nullable();
            $table->integer('customer_package_id')->nullable();
            $table->integer('remaining_uploads')->nullable();
            $table->boolean('deletable')->default(true);
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
        Schema::dropIfExists('users');
    }
}
