<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('description', 500);
            $table->decimal('score');
            $table->decimal('price');
            $table->integer('category_id');
            $table->integer('brand_id');

            
            //$table->foreign('category_id')->references()->on('categories')->onDelete('restrict');
            //$table->foreign('brand_id')->references()->on('brands')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
