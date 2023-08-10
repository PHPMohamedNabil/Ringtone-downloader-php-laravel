<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRingTonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ring_tones', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('slug');
            $table->string('file');
            $table->string('format')->nullable();
            $table->string('size')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL')->onUpdate('SET NULL');
            $table->string("download")->default(0);
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
        Schema::dropIfExists('ring_tones');
    }
}
