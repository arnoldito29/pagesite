<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessagesTableModifiers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( Schema::hasTable('messages') ) {
            
            if (!Schema::hasColumn('messages', 'updated_at')) {
                
                Schema::table('messages', function (Blueprint $table) {
                    
                    $table->timestamp('updated_at')->nullable()->after('created_at');
                });
            }
            
            if (!Schema::hasColumn('messages', 'status')) {
                
                Schema::table('messages', function (Blueprint $table) {
                    
                    $table->enum('status', array('send', 'waiting'))->default('waiting');
                });
            }
            
            if (!Schema::hasColumn('messages', 'lang')) {
                
                Schema::table('messages', function (Blueprint $table) {
                    
                    $table->string('lang');
                });
            }
            
            if (!Schema::hasColumn('messages', 'type')) {
                
                Schema::table('messages', function (Blueprint $table) {
                    
                    $table->enum('type', array('web', 'api'))->nullable()->after('updated_at');
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
