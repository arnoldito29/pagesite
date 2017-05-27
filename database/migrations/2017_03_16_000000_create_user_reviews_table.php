<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('user_reviews') ) {
            
            Schema::create('user_reviews', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->unsignedInteger('user_id');
                $table->unsignedInteger('user_to_id');
                $table->text('message');
                $table->unsignedInteger('ride_id')->nullable();
                $table->enum('status', ['confirm', 'cancel'])->default( 'confirm' );
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
        //Schema::drop('user_reviews');
    }
}
