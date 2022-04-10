<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_phones', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('phone_os')->nullable();
            $table->string('phone_cpu')->nullable();
            $table->string('phone_memory')->nullable();
            $table->string('phone_display')->nullable();
            $table->string('phone_storage')->nullable();
            $table->string('phone_camera')->nullable();
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
        Schema::dropIfExists('product_phones');
    }
}