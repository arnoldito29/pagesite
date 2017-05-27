<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersTableModifiers2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( Schema::hasTable('users') ) {
            
            if (!Schema::hasColumn('users', 'birthday')) {
                
                Schema::table('users', function (Blueprint $table) {
                    
                    $table->unsignedInteger('birthday')->nullable()->after('password');
                });
            }
            
            if (!Schema::hasColumn('users', 'sex')) {
                
                Schema::table('users', function (Blueprint $table) {
                    
                    $table->string('sex')->nullable()->after('birthday');
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
        //Schema::drop('users');
    }
}
