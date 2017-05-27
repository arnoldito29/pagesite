<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('devices') ) {
            
            Schema::create('devices', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamp('created_at')->nullable();
                $table->unsignedInteger('user_id');
                $table->unsignedInteger('type');
                $table->text('token');
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
        //Schema::drop('devices');
    }
}
