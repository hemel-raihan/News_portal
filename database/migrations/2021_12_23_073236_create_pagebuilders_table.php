<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagebuildersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagebuilders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('custompage_id');
            $table->string('title')->nullable();
            $table->string('layout')->default('one-col');
            $table->string('padding')->nullable();
            $table->string('margin')->nullable();
            $table->string('border')->nullable();
            $table->string('bordercolor')->nullable();
            $table->string('border_style')->nullable();
            $table->string('background_img')->nullable();
            $table->string('background_color')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('order')->nullable();
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
        Schema::dropIfExists('pagebuilders');
    }
}
