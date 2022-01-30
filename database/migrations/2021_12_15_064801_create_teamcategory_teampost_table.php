<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamcategoryTeampostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teamcategory_teampost', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teampost_id')->constrained('teamposts')->onDelete('cascade');
            $table->foreignId('teamcategory_id')->constrained('teamcategories')->onDelete('cascade');
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
        Schema::dropIfExists('teamcategory_teampost');
    }
}
