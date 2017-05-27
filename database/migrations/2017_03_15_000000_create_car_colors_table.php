<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('car_colors') ) {
            
            Schema::create('car_colors', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('sort');
                $table->string('name_lt')->nullable();
                $table->string('name_lv')->nullable();
                $table->string('name_ee')->nullable();
                $table->string('name_en')->nullable();
                $table->string('name_ru')->nullable();
                $table->string('name_pl')->nullable();
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
        //Schema::drop('car_colors');
    }
}
