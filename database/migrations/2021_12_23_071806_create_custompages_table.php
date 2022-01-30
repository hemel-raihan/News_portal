<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustompagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custompages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('type');
            $table->string('container');
            $table->string('background_img')->nullable();
            $table->string('background_color')->nullable();
            $table->boolean('transparent')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('leftsidebar_id')->nullable();
            $table->integer('rightsidebar_id')->nullable();
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
        Schema::dropIfExists('custompages');
    }
}
