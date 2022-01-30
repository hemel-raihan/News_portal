<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricePricecategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_pricecategory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('price_id')->constrained('prices')->onDelete('cascade');
            $table->foreignId('pricecategory_id')->constrained('pricecategories')->onDelete('cascade');
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
        Schema::dropIfExists('price_pricecategory');
    }
}
