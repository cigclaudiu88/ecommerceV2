<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('brand')->nullable()->after('profile_photo_path');
            $table->string('category')->nullable()->after('profile_photo_path');
            $table->string('subcategory')->nullable()->after('profile_photo_path');
            $table->string('product')->nullable()->after('profile_photo_path');
            $table->string('slider')->nullable()->after('profile_photo_path');
            $table->string('voucher')->nullable()->after('profile_photo_path');
            $table->string('shipping')->nullable()->after('profile_photo_path');
            $table->string('orders')->nullable()->after('profile_photo_path');
            $table->string('stock')->nullable()->after('profile_photo_path');
            $table->string('reports')->nullable()->after('profile_photo_path');
            $table->string('alluser')->nullable()->after('profile_photo_path');
            $table->string('blog')->nullable()->after('profile_photo_path');
            $table->string('setting')->nullable()->after('profile_photo_path');
            $table->string('return_order')->nullable()->after('profile_photo_path');
            $table->string('review')->nullable()->after('profile_photo_path');
            $table->string('admin_user_role')->nullable()->after('profile_photo_path');
            $table->integer('type')->nullable()->after('profile_photo_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('brand');
            $table->dropColumn('category');
            $table->dropColumn('subcategory');
            $table->dropColumn('product');
            $table->dropColumn('slider');
            $table->dropColumn('voucher');
            $table->dropColumn('shipping');
            $table->dropColumn('orders');
            $table->dropColumn('stock');
            $table->dropColumn('reports');
            $table->dropColumn('alluser');
            $table->dropColumn('blog');
            $table->dropColumn('setting');
            $table->dropColumn('return_order');
            $table->dropColumn('review');
            $table->dropColumn('admin_user_role');
            $table->dropColumn('type');
        });
    }
}