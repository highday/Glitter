<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('image_id')->unsigned()->nullable();
            $table->foreign('image_id')->references('id')->on('media')->onDelete('set null');
            $table->string('option1')->nullable();
            $table->string('option2')->nullable();
            $table->string('option3')->nullable();
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->decimal('price', 13, 3);
            $table->decimal('reference_price', 13, 3)->nullable();
            $table->boolean('taxes_included');
            $table->string('inventory_management')->nullable();
            $table->integer('inventory_quantity')->unsigned()->nullable();
            $table->boolean('out_of_stock_purchase');
            $table->boolean('requires_shipping');
            $table->decimal('weight', 13, 3)->nullable();
            $table->string('weight_unit')->nullable();
            $table->string('fulfillment_service');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variants');
    }
}
