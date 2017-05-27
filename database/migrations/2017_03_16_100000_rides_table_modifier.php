<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RidesTableModifier extends Migration
{
    public function __construct()
    {
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( Schema::hasTable('rides') ) {
            
            if (!Schema::hasColumn('rides', 'user_car_id')) {
                
                Schema::table('rides', function (Blueprint $table) {
                    
                    $table->unsignedInteger('user_car_id')->nullable()->after('user_id');
                });
            }
            
            if (Schema::hasColumn('rides', 'cigarettes')) {
                
                Schema::table('rides', function (Blueprint $table2) {
                    
                    $table2->renameColumn('cigarettes', 'smoke');
                });
            }
            
            if (!Schema::hasColumn('rides', 'comment')) {
                
                Schema::table('rides', function (Blueprint $table) {
                    
                    $table->text('comment')->nullable()->after('to_id');
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
        //Schema::drop('rides');
    }
}
