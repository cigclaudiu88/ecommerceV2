<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // structura tabelului vouchers
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_name');
            $table->integer('voucher_discount');
            $table->string('voucher_validity');
            // status daca voucherul este activ sau nu
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('vouchers');
    }
}