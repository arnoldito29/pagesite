<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('book_seats') ) {
            
            Schema::create('book_seats', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->enum('type', array('web', 'api'))->nullable();
                $table->unsignedInteger('ride_id');
                $table->unsignedInteger('user_id');
                $table->text('comment')->nullable();
                $table->enum('status', array('cancel', 'confirm', 'waiting'))->default('waiting');
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
        //Schema::drop('book_seats');
    }
}
