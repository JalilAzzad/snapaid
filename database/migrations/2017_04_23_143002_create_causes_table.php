<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('causes_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->mediumText('description')->nullable();
            $table->timestamps();
        });

        Schema::create('causes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->index()->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->string('file_ext')->nullable();
            $table->mediumText('description')->nullable();
            $table->timestamps();
        });

        Schema::create('cause_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('cause_id')->index();
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
        Schema::dropIfExists('causes');
        Schema::dropIfExists('causes_categories');
        Schema::dropIfExists('cause_user');
    }
}
