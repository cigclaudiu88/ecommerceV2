<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTabletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_tablets', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('tablet_os')->nullable();
            $table->string('tablet_cpu')->nullable();
            $table->string('tablet_memory')->nullable();
            $table->string('tablet_display')->nullable();
            $table->string('tablet_storage')->nullable();
            $table->string('tablet_camera')->nullable();
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
        Schema::dropIfExists('product_tablets');
    }
}