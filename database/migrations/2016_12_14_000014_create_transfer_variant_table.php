<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferVariantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_variant', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transfer_id')->unsigned();
            $table->foreign('transfer_id')->references('id')->on('transfers')->onDelete('cascade');
            $table->integer('variant_id')->unsigned()->nullable();
            $table->foreign('variant_id')->references('id')->on('variants')->onDelete('cascade');
            $table->integer('quantity')->unsigned();
            $table->integer('accepted')->unsigned()->default(0);
            $table->integer('canceled')->unsigned()->default(0);
            $table->integer('rejected')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfer_variant');
    }
}
