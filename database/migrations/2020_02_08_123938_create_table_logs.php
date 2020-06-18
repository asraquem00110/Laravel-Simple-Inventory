<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemlogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event');
            $table->integer('item_id')->nullable();
            $table->integer('itemlist_id')->nullable();
            $table->float('oldvalue')->nullable();
            $table->float('newvalue')->nullable();
            $table->integer('inbound_id')->nullable();
            $table->integer('outbound_id')->nullable();
            $table->string('remarks')->nullable();
            $table->string('modifiedby');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itemlogs');
    }
}
