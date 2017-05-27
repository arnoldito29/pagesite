<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('locations') ) {
            
            Schema::create('locations', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->string('name_lt')->nullable();
                $table->string('original_lt')->nullable();
                $table->string('name_lv')->nullable();
                $table->string('original_lv')->nullable();
                $table->string('name_ee')->nullable();
                $table->string('original_ee')->nullable();
                $table->string('name_en')->nullable();
                $table->string('original_en')->nullable();
                $table->string('name_ru')->nullable();
                $table->string('original_ru')->nullable();
                $table->string('name_pl')->nullable();
                $table->string('original_pl')->nullable();
                $table->float('latitude', 10, 7);
                $table->float('longitude', 10, 7);
                $table->string('place_id')->nullable();
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
        //Schema::drop('locations');
    }
}
