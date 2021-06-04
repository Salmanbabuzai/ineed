<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('userType')->nullable();
            $table->string('user_fname')->nullable();
            $table->string('user_lname')->nullable();
            $table->string('email')->unique();
            $table->string('user_phone')->nullable();
            $table->string('password');
            $table->string('user_city')->nullable();
            $table->string('user_address')->nullable();
            $table->integer('user_needs')->default(0);
            $table->integer('user_offers')->default(0);
            $table->string('user_photo')->default('defaultUser.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
