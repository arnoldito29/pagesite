<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('settings') ) {
            
            Schema::create('settings', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('sort');
                $table->string('name');
                $table->string('url_lt');
                $table->tinyInteger('new_window_lt')->nullable();
                $table->string('url_lv');
                $table->tinyInteger('new_window_lv')->nullable();
                $table->string('url_ee');
                $table->tinyInteger('new_window_ee')->nullable();
                $table->string('url_en');
                $table->tinyInteger('new_window_en')->nullable();
                $table->string('url_ru');
                $table->tinyInteger('new_window_ru')->nullable();
                $table->string('url_pl');
                $table->tinyInteger('new_window_pl')->nullable();
                $table->string('url_ua');
                $table->tinyInteger('new_window_ua')->nullable();
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
        //Schema::drop('settings');
    }
}
