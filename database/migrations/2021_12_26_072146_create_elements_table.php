<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pagebuilder_id');
            $table->string('module_type')->nullable();
            $table->string('layout')->nullable();
            $table->string('title')->nullable();
            $table->string('post_qty')->nullable();
            $table->string('image')->nullable();
            $table->string('img_width')->nullable();
            $table->string('img_height')->nullable();
            $table->string('img_margin')->nullable();
            $table->string('margin_amt')->nullable();
            $table->string('img_topmargin')->nullable();
            $table->string('topmargin_amt')->nullable();
            $table->text('body')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('elements');
    }
}
