<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_drill', function (Blueprint $table) {
            $table->string('pdfPath')->nullable()->change();
        });

        Schema::table('products_oil', function (Blueprint $table) {
            $table->string('pdf1Path')->nullable()->change();
            $table->string('pdf2Path')->nullable()->change();
        });
    }
}
