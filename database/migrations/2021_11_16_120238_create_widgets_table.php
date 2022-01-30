<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sidebar_id')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->integer('no_of_post')->nullable();
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->boolean('status')->nullable();
            $table->string('type')->nullable();
            $table->string('image')->nullable();
            $table->string('gallary_image')->nullable();
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
        Schema::dropIfExists('widgets');
    }
}
