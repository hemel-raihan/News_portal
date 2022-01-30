<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('image')->default('default.png')->nullable();
            $table->text('body')->nullable();
            $table->integer('view_count')->default(0);
            $table->boolean('status')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->integer('rightsidebar_id')->nullable();
            $table->integer('leftsidebar_id')->nullable();
            $table->string('order')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_desc')->nullable();
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
        Schema::dropIfExists('services');
    }
}
