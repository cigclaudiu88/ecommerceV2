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
        // structura tabelei products
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // cheie externa catre tabela brands
            $table->integer('brand_id');
            // cheie externa catre tabela categories
            $table->integer('category_id');
            // cheie externa catre tabela sub_categories
            $table->integer('subcategory_id');
            // cheie externa catre tabela sub_sub_categories
            $table->integer('subsubcategory_id');
            $table->string('product_name')->unique();
            $table->string('product_slug');
            $table->string('product_code')->unique();
            $table->integer('product_quantity');
            $table->decimal('selling_price', $precision = 8, $scale = 2);
            $table->decimal('discount_price', $precision = 8, $scale = 2)->nullable();
            $table->text('short_description');
            $table->text('specifications');
            $table->text('long_description');
            $table->string('product_thumbnail');
            $table->integer('hot_deal')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deal')->nullable();
            $table->integer('status')->default(0);
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