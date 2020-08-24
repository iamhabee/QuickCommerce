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
            $table->timestamps();
            $table->string('name');
            $table->integer('price');
            $table->integer('salePrice');
            $table->integer('discount');
            $table->integer('product_image_id');
            $table->string('shortDetails');
            $table->string('description');
            $table->boolean('new');
            $table->boolean('sale');
            $table->string('category');
            $table->integer('color_id');
            $table->integer('stock');
            $table->integer('size_id');
            $table->integer('tag_id');
            $table->integer('ratings');
            $table->integer('variant_id');
        });
    }
    // "variants": [
    // {
    //   "color": "green",
    //   "images": "/assets/images/fashion/product/31.jpg"
    // },
    // {
    //   "color": "gray",
    //   "images": "/assets/images/fashion/product/24.jpg"
    // }]
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
