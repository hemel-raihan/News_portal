<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->default('default.png')->nullable();
            $table->text('gallaryimage');
            $table->text('body')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->integer('rightsidebar_id');
            $table->integer('leftsidebar_id');
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
        Schema::dropIfExists('pages');
    }
}
