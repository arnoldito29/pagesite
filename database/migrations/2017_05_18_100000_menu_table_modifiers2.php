<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenuTableModifiers2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( Schema::hasTable('menu') ) {
            
            if (!Schema::hasColumn('menu', 'new_window')) {
                
                Schema::table('menu', function (Blueprint $table) {
                    
                    $table->unsignedInteger('new_window')->nullable()->after('name');
                });
            }
            
            if (!Schema::hasColumn('menu', 'url')) {
                
                Schema::table('menu', function (Blueprint $table) {
                    
                    $table->string('url')->nullable()->after('name');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::drop('menu');
    }
}
