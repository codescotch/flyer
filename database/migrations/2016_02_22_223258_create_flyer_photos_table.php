<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlyerPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flyer_photos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('flyer_id')->unsigned();
            $table->foreign('flyer_id')->references('id')->on('flyers')->onDelete('cascade');

            // note: came back way later and added some fields (apparently fine)
            // did php artisan migrate:refresh after to roll everything back and migrate (might be necessary?)
            $table->string('name');
            $table->string('path');
            $table->string('thumbnail_path');
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
        Schema::drop('flyer_photos');
    }
}
