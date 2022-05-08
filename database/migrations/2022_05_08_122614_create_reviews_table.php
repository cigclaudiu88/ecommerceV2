<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // structura tabelului reviews
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('product_id')->unsigned();
            $table->unSignedBigInteger('user_id')->unsigned();
            $table->text('comment');
            $table->string('summary');
            // la stergerea produsului se sterge si review-ul aferente
            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade');
            // la stergerea utilizatorului, se sterge inregistrarea din tabelul reviews aferenta acestui utilizator
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('status')->default(0);
            $table->integer('rating')->default(0);
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
        Schema::dropIfExists('reviews');
    }
}