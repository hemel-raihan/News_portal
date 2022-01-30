<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentcategoryContentpostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contentcategory_contentpost', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contentpost_id')->constrained('contentposts')->onDelete('cascade');
            $table->foreignId('contentcategory_id')->constrained('contentcategories')->onDelete('cascade');
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
        Schema::dropIfExists('contentcategory_contentpost');
    }
}
