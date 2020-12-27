<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductsDrill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_drill', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('subcategory_id')->unsigned()->nullable();
            $table->smallInteger('active')->unsigned()->default(1);
            $table->smallInteger('position')->unsigned()->default(0);
            $table->string('name');
            $table->mediumText('description');
            $table->string('pdfPath');
            $table->timestamps();
            $table->index('id', 'id_drill');
            $table->index('brand_id', 'brand_id_drill');
            $table->index('category_id', 'category_id_drill');
            $table->index('subcategory_id', 'subcategory_id_drill');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_drill');
    }
}
