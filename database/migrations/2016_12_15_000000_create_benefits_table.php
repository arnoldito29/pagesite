<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBenefitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('benefits') ) {
            
            Schema::create('benefits', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('sort');
                $table->text('text_lt');
                $table->text('text_lv');
                $table->text('text_ee');
                $table->text('text_en');
                $table->text('text_ru');
                $table->text('text_pl');
                $table->enum('type', array('passanger', 'driver'))->nullable();
                $table->dateTime('create');
                $table->tinyInteger('deleted')->nullable();
                $table->tinyInteger('active')->nullable();
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
        //Schema::drop('benefits');
    }
}
