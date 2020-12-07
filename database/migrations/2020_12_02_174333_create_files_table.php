<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id');
            $table->boolean('is_using')->default(true);
            $table->longText('path')->nullable();
            $table->text('name')->nullable();
            $table->text('upload_name')->nullable();
            $table->text('type')->nullable();
            $table->text('target')->nullable();
            $table->integer('size')->nullable();
            $table->string('extension')->nullable();
            $table->string('mime_type')->nullable();
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
        Schema::dropIfExists('files');
    }
}
