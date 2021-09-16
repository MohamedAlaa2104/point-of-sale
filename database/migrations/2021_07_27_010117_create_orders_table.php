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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('type');
            $table->integer('payment_type');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('state');
            $table->string('city');
            $table->string('street');
            $table->string('phone', 50);
            $table->string('post_code');
            $table->string('company_name');
            $table->string('commercial_register');
            $table->string('tax_number');
            $table->text('inquiry')->nullable();
            $table->enum('status', [0,1,2]);
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
