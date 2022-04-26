<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAditionalColumnsOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('voucher_name')->nullable()->after('currency');
            $table->string('discount_amount')->nullable()->after('currency');
            $table->string('subtotal')->after('currency');
            $table->string('tax')->after('currency');
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
            $table->dropColumn('voucher_name');
            $table->dropColumn('discount_amount');
            $table->dropColumn('subtotal');
            $table->dropColumn('tax');
        });
    }
}