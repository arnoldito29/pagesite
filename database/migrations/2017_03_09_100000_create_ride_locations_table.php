<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRideLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('ride_locations') ) {
            
            Schema::create('ride_locations', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id')->nullable();
                $table->unsignedInteger('ride_id')->nullable();
                $table->unsignedInteger('location_id')->nullable();
                $table->dateTime('departure_datetime')->nullable();
                $table->unsignedTinyInteger('type')->nullable();
                $table->unsignedTinyInteger('deleted')->nullable();
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
        //Schema::drop('ride_locations');
    }
}
