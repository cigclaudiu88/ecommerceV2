<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // structura tabelei sliders
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('slider_image');
            $table->string('slider_title')->nullable();
            $table->text('slider_description')->nullable();
            $table->integer('slider_status')->default(1);
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
        Schema::dropIfExists('sliders');
    }
}