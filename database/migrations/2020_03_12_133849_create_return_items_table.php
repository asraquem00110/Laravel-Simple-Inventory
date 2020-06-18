<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('return_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('return_id');
            $table->integer('item_id');
            $table->integer('itemlist_id')->nullable();
            $table->float('qty')->default(0);
            $table->string('uom')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('return_item');
    }
}
