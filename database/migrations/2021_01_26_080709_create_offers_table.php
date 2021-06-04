<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('post_id');
            $table->string('offer_amount');
            $table->string('delivery_time');
            $table->string('delivery_charges');
            $table->string('payment_method');
            $table->timestamp('offer_date')->useCurrent();
            $table->integer('emailSent');
            $table->integer('notification');
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
        Schema::dropIfExists('offers');
    }
}
