<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('rides') ) {
            
            Schema::create('rides', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamp('created_at')->nullable();
                $table->timestamp('departure_datetime')->nullable();
                $table->unsignedInteger('user_id');
                $table->unsignedInteger('from_id');
                $table->unsignedInteger('to_id');
                $table->text('maps_json');
                $table->tinyInteger('pet')->default('0');
                $table->tinyInteger('music')->default('0');
                $table->tinyInteger('cigarettes')->default('0');
                $table->tinyInteger('food')->default('0');
                $table->enum('sex', ['mix', 'girls', 'boys'])->default( 'mix' );
                $table->tinyInteger('bag')->default('0');
                $table->tinyInteger('free')->nullable();
                $table->decimal('price', 5, 2);
                $table->tinyInteger('user_car_free_seats')->nullable();
                $table->tinyInteger('card')->nullable();
                $table->tinyInteger('cash')->nullable();
                $table->tinyInteger('return_ride')->nullable();
                $table->tinyInteger('deleted')->nullable();
                $table->string('lang');
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
        //Schema::drop('rides');
    }
}
