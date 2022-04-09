<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // structura tabelei sub_subcategories
        Schema::create('sub_sub_categories', function (Blueprint $table) {
            $table->id();
            // cheie externa la tabela categories
            $table->integer('category_id');
            // cheie externa la tabela subcategories
            $table->integer('subcategory_id');
            $table->string('subsubcategory_name');
            $table->string('subsubcategory_slug');
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
        Schema::dropIfExists('sub_sub_categories');
    }
}