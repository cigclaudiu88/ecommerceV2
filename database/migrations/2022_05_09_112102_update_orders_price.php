<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('subtotal', $precision = 8, $scale = 2)->change();
            $table->decimal('discount_amount', $precision = 8, $scale = 2)->change();
            $table->decimal('tax', $precision = 8, $scale = 2)->change();
            $table->decimal('amount', $precision = 8, $scale = 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('subtotal')->change();
            $table->integer('discount_amount')->change();
            $table->integer('tax')->change();
            $table->integer('amount')->change();
        });
    }
}