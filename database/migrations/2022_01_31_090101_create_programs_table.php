<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programcategory_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->text('body')->nullable();
            $table->string('poster')->nullable();
            $table->string('video')->nullable();
            $table->string('embed_code')->nullable();
            $table->string('start_date')->nullable();
            $table->time('start_time')->nullable();
            $table->string('start_datetime')->nullable();
            $table->string('end_date')->nullable();
            $table->time('end_time')->nullable();
            $table->string('end_datetime')->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('programs');
    }
}
