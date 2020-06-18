<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatch_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('dispatch_id');
            $table->integer('item_id');
            $table->integer('itemlist_id')->nullable();
            $table->float('qty')->default(0);
            $table->string('uom')->nullable();
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
        Schema::dropIfExists('dispatch_item');
    }
}
