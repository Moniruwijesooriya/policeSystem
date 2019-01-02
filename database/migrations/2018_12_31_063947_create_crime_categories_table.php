<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrimeCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crime_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('crimeType');
            $table->string('categoryType');
            $table->string('description');
            $table->string('policeView');
            $table->string('citizenView');



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
        Schema::dropIfExists('crime_categories');
    }
}
