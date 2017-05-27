<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RequestsTableModifiers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( Schema::hasTable('requests') ) {
            
            if (!Schema::hasColumn('requests', 'type')) {
                
                Schema::table('requests', function (Blueprint $table) {
                    
                    $table->string('type')->nullable()->after('status');
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
        //Schema::drop('requests');
    }
}
