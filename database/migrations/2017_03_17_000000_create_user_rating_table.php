<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('user_ratings') ) {
            
            Schema::create('user_ratings', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->unsignedInteger('user_id');
                $table->unsignedInteger('user_to_id');
                $table->unsignedInteger('rating');
                $table->unsignedInteger('message_id')->nullable();
                $table->unsignedInteger('ride_id')->nullable();
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
        //Schema::drop('user_ratings');
    }
}
