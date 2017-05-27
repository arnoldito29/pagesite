<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('user_cars') ) {
            
            Schema::create('user_cars', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('car_model_id');
                $table->unsignedInteger('user_id');
                $table->unsignedInteger('years')->nullable();
                $table->unsignedInteger('color_id')->nullable();
                $table->tinyInteger('deleted')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::drop('user_cars');
    }
}
