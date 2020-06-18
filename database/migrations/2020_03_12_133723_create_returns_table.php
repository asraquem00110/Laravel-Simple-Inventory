<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('returns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('refNo')->nullable();
            $table->integer('client_id');
            $table->datetime('datereturn');
            $table->string('dispatch_refno')->nullable();
            $table->string('preparedby')->nullable();
            $table->integer('user_id');
            $table->integer('status')->default(1);
            $table->string('LastModifiedBy')->nullable();
            $table->datetime('ApprovedDateTime')->nullable();
            $table->string('approvedby')->nullable();
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
        Schema::dropIfExists('returns');
    }
}
