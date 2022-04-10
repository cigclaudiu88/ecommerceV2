<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLaptopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_laptops', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('laptop_os')->nullable();
            $table->string('laptop_cpu')->nullable();
            $table->string('laptop_gpu')->nullable();
            $table->string('laptop_memory')->nullable();
            $table->string('laptop_display')->nullable();
            $table->string('laptop_storage')->nullable();
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
        Schema::dropIfExists('product_laptops');
    }
}