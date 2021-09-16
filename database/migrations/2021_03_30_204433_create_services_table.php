<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name_en', 50);
            $table->string('name_ar', 50);
            $table->text('small_description_en');
            $table->text('small_description_ar');
            $table->longText('description_en');
            $table->longText('description_ar');
            $table->string('slider_phrase_en');
            $table->string('slider_phrase_ar');
            $table->enum('active', [0, 1])->default(1);
            $table->string('slug', 50);
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
        Schema::dropIfExists('services');
    }
}
