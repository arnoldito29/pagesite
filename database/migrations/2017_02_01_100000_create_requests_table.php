<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('requests') ) {
            
            Schema::create('requests', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id')->nullable();
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->unsignedInteger('from_id')->nullable();
                $table->dateTime('from_date')->nullable();
                $table->unsignedInteger('to_id')->nullable();
                $table->dateTime('to_date')->nullable();
                $table->text('data')->nullable();
                $table->enum('status', array('wait', 'sent'));
                $table->string('lang')->nullable();
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
        //Schema::drop('requests');
    }
}
