<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInbounds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inbounds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('client_id');
            $table->string('driver')->nullable();
            $table->string('plateNo')->nullable();
            $table->string('container')->nullable();
            $table->string('refNo')->nullable();
            $table->string('controlNo')->nullable();
            $table->date('unloadDate');
            $table->time('unloadTime');
            $table->time('finishUnloadTime');
            $table->string('origin')->nullable();
            $table->string('receivedby')->nullable();
            $table->string('checkedby')->nullable();
            $table->string('notedby')->nullable();
            $table->timestamps();
        });

        Schema::table('itemlists', function (Blueprint $table) {
          $table->integer('inbound_id')->nullable()->after('freeStorage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inbounds');
    }
}
