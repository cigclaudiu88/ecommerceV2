<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // structura tabelului orders (comenzi)
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            // Date pentru Adresa de Livrare
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('district_id');
            $table->string('shipping_first_name');
            $table->string('shipping_last_name');
            $table->string('shipping_phone');
            $table->string('shipping_email');
            $table->string('shipping_street');
            $table->string('shipping_street_number');
            $table->string('shipping_building')->nullable();
            $table->string('shipping_apartment')->nullable();
            $table->text('notes')->nullable();
            // Date aferente comenzii
            $table->string('payment_type');
            $table->string('payment_method')->nullable();
            $table->string('transaction_id');
            $table->string('currency');
            $table->float('amount', 8, 2);
            $table->string('order_number');
            $table->string('invoice_no');
            $table->string('order_date');
            $table->string('order_month');
            $table->string('order_year');
            $table->string('confirmed_date')->nullable();
            $table->string('processing_date')->nullable();
            $table->string('picked_date')->nullable();
            $table->string('shipped_date')->nullable();
            $table->string('delivered_date')->nullable();
            $table->string('cancel_date')->nullable();
            $table->string('return_date')->nullable();
            $table->string('return_reason')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('orders');
    }
}