<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Metalworking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metalworking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('active')->unsigned()->default(1);
            $table->smallInteger('position')->unsigned()->default(0);
            $table->string('name')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('imgPath');
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
        Schema::dropIfExists('metalworking');
    }
}
