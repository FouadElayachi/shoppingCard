<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts_discounts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::table('carts_discounts', function (Blueprint $table) {
            $table->foreignId('discount_id')->constrained('discounts')->onDelete('cascade');
            $table->foreignId('cart_id')->constrained('carts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts_discounts');
    }
}
