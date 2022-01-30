<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->foreignId('brand_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('unit')->nullable();
            $table->string('purchase_qty')->nullable();
            $table->string('tags')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('variant_product')->nullable();
            $table->string('attributes')->nullable();
            $table->string('choice_options')->nullable();
            $table->string('colors')->nullable();
            $table->string('discount_startdate')->nullable();
            $table->string('discount_enddate')->nullable();
            $table->string('discount_rate')->nullable();
            $table->string('discount_type')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('sku')->nullable();
            $table->string('image')->default('default.png')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('gallaryimage')->nullable();
            $table->text('desc')->nullable();
            $table->string('tax')->nullable();
            $table->string('tax_type')->nullable();
            $table->integer('view_count')->default(0);
            $table->boolean('status')->default(false);
            $table->boolean('scrollable')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->integer('rightsidebar_id')->nullable();
            $table->integer('leftsidebar_id')->nullable();
            $table->integer('digital')->default(0);
            $table->string('files')->nullable();
            $table->integer('shipping')->nullable();
            $table->integer('low_stock_qty')->nullable();
            $table->integer('min_qty')->default(1);
            $table->boolean('cash_on_delivery')->nullable();
            $table->boolean('featured')->nullable();
            $table->boolean('todays_deal')->nullable();
            $table->integer('estimate_shipping_time')->nullable();
            $table->integer('num_of_sale')->default(0);
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
        Schema::dropIfExists('products');
    }
}
