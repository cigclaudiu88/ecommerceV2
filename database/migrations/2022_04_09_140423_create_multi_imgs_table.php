<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultiImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // se creeaza tabela multi_imgs
        Schema::create('multi_imgs', function (Blueprint $table) {
            $table->id();
            // cheia externa la tabela products
            $table->integer('product_id');
            $table->string('photo_name');
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
        Schema::dropIfExists('multi_imgs');
    }
}