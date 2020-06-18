<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovedDateTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outbounds',function(Blueprint $table){
            $table->datetime('ApprovedDateTime')->nullable();
        });

        Schema::table('dispatches',function(Blueprint $table){
            $table->datetime('ApprovedDateTime')->nullable();
        });

        Schema::table('inbounds',function(Blueprint $table){
            $table->datetime('ApprovedDateTime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
