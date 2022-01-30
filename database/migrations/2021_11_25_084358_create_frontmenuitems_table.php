<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontmenuitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frontmenuitems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('frontmenu_id');
            //$table->enum('type',['item','divider'])->default('item');
            $table->string('type')->nullable();
            $table->integer('parent_id')->nullable()->default(0);
            $table->integer('page_id')->nullable();
            $table->integer('contentcategory_id')->nullable();
            $table->integer('blogcategory_id')->nullable();
            $table->integer('teamcategory_id')->nullable();
            $table->integer('order')->nullable();
            $table->string('title')->nullable();
            $table->string('divider_title')->nullable();
            $table->string('slug')->nullable();
            $table->string('url')->nullable();
            $table->string('target')->nullable();
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
        Schema::dropIfExists('frontmenuitems');
    }
}
