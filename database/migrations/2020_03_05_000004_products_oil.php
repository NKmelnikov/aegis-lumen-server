<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductsOil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_oil', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('subcategory_id')->unsigned()->nullable();
            $table->smallInteger('active')->unsigned()->default(1);
            $table->smallInteger('position')->unsigned()->default(0);
            $table->string('name');
            $table->string('slug');
            $table->mediumText('description');
            $table->mediumText('spec');
            $table->string('imgPath');
            $table->string('pdf1Path');
            $table->string('pdf2Path');
            $table->timestamps();
            $table->index('id', 'id_oil');
            $table->index('slug', 'slug_oil');
            $table->index('brand_id', 'brand_id_oil');
            $table->index('category_id','category_id_oil');
            $table->index('subcategory_id', 'subcategory_id_oil');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_oil');
    }
}
