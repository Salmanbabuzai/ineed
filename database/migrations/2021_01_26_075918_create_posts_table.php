<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('post_title');
            $table->string('post_details');
            $table->string('post_category');
            $table->string('post_subcategory');
            $table->string('post_maxdays');
            $table->string('post_city');
            $table->integer('post_budget');
            $table->timestamp('post_date')->useCurrent();
            $table->string('post_pic1');
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
        Schema::dropIfExists('posts');
    }
}
