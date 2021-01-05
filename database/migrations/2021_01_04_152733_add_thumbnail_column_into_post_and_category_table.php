<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThumbnailColumnIntoPostAndCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->longText('thumbnail')->nullable();
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->longText('thumbnail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('thumbnail');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('thumbnail');
        });
    }
}
