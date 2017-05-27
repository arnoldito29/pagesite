<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessengerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('messenger') ) {
            
            Schema::create('messenger', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('from_id');
                $table->unsignedInteger('user_id');
                $table->enum('status', array('open', 'minimise', 'close'))->default('minimise');
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
        //Schema::drop('messenger');
    }
}
