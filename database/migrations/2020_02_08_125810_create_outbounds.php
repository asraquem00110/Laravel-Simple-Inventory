<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutbounds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outbounds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('client_id');
            $table->string('driver')->nullable();
            $table->string('plateNo')->nullable();
            $table->string('container')->nullable();
            $table->string('refNo')->nullable();
            $table->string('controlNo')->nullable();
            $table->date('loadDate');
            $table->time('loadTime');
            $table->time('finishloadTime');
            $table->string('origin')->nullable();
            $table->string('preparedby')->nullable();
            $table->string('approvedby')->nullable();
            $table->string('receivedby')->nullable();
            $table->string('checkedby')->nullable();
            $table->string('guardOnDuty')->nullable();
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
        Schema::dropIfExists('outbounds');
    }
}
