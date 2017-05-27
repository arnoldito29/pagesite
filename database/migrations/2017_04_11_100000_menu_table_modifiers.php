<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenuTableModifiers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( Schema::hasTable('menu') ) {
            
            if (!Schema::hasColumn('menu', 'admin')) {
                
                Schema::table('menu', function (Blueprint $table) {
                    
                    $table->unsignedInteger('admin');
                });
            }
            
            if (!Schema::hasColumn('menu', 'active')) {
                
                Schema::table('menu', function (Blueprint $table) {
                    
                    $table->unsignedInteger('active')->nullable();
                });
            }
            
            if (!Schema::hasColumn('menu', 'sort')) {
                
                Schema::table('menu', function (Blueprint $table) {
                    
                    $table->unsignedInteger('sort')->nullable()->after('id');
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
        //Schema::drop('messages');
    }
}
