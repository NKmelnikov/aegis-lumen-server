<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Catalogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned()->index()->nullable();
            $table->smallInteger('active')->unsigned()->default(1);
            $table->smallInteger('position')->unsigned()->default(0);
            $table->string('name')->nullable();
            $table->string('pdfPath');
            $table->timestamps();
            $table->index('id', 'id_catalogs');
            $table->index('brand_id', 'brand_id_catalogs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogs');
    }
}
