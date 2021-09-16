<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('keywords_ar');
            $table->string('keywords_en');
            $table->text('description_ar');
            $table->text('description_en');
            $table->string('email');
            $table->string('phone');
            $table->string('website_link');
            $table->string('address_ar');
            $table->string('address_en');
            $table->longText('map');
            $table->string('facebook');
            $table->string('linkedin');
            $table->string('youtube');
            $table->string('instagram');
            $table->string('twitter');

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
        Schema::dropIfExists('settings');
    }
}
