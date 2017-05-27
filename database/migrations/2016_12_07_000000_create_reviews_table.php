<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('reviews') ) {
            
            Schema::create('reviews', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name_lt');
                $table->text('text_lt');
                $table->string('name_lv');
                $table->text('text_lv');
                $table->string('name_ee');
                $table->text('text_ee');
                $table->string('name_en');
                $table->text('text_en');
                $table->string('name_ru');
                $table->text('text_ru');
                $table->string('name_pl');
                $table->text('text_pl');
                $table->string('image');
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
        //Schema::drop('users');
    }
}
