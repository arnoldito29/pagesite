<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersTableModifiers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( Schema::hasTable('users') ) {
            
            if (!Schema::hasColumn('users', 'surname')) {
                
                Schema::table('users', function (Blueprint $table) {
                    
                    $table->string('surname')->nullable()->after('name');
                });
            }
			
            if (!Schema::hasColumn('users', 'phone')) {
                
                Schema::table('users', function (Blueprint $table) {
                    
                    $table->string('phone')->nullable()->after('surname');
                });
            }
            
            if (!Schema::hasColumn('users', 'image')) {
                
                Schema::table('users', function (Blueprint $table) {
                    
                    $table->string('image')->nullable()->after('phone');
                });
            }
            
            if (!Schema::hasColumn('users', 'facebook_access_token')) {
                
                Schema::table('users', function (Blueprint $table) {
                    
                    $table->string('facebook_access_token')->nullable()->after('api_token');
                });
            }
            
            if (!Schema::hasColumn('users', 'facebook_access_token_create_date')) {
                
                Schema::table('users', function (Blueprint $table) {
                    
                    $table->dateTime('facebook_access_token_create_date')->nullable()->after('facebook_access_token');
                });
            }
            
            if (!Schema::hasColumn('users', 'facebook_friends_count')) {
                
                Schema::table('users', function (Blueprint $table) {
                    
                    $table->unsignedInteger('facebook_friends_count')->nullable()->after('facebook_access_token_create_date');
                });
            }
            
            if (!Schema::hasColumn('users', 'facebook_user_id')) {
                
                Schema::table('users', function (Blueprint $table) {
                    
                    $table->string('facebook_user_id')->nullable()->after('facebook_friends_count');
                });
            }
            
            if (!Schema::hasColumn('users', 'lang')) {
                
                Schema::table('users', function (Blueprint $table) {
                    
                    $table->string('lang')->nullable()->after('facebook_user_id');
                });
            }
            
            if (!Schema::hasColumn('users', 'deleted')) {
                
                Schema::table('users', function (Blueprint $table) {
                    
                    $table->unsignedInteger('deleted')->nullable();
                });
            }
            
            if (!Schema::hasColumn('users', 'active')) {
                
                Schema::table('users', function (Blueprint $table) {
                    
                    $table->unsignedInteger('active')->nullable();
                });
            }
            
            if (!Schema::hasColumn('users', 'last_active')) {
                
                Schema::table('users', function (Blueprint $table) {
                    
                    $table->dateTime('last_active')->nullable();
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
        //Schema::drop('ride_locations');
    }
}
