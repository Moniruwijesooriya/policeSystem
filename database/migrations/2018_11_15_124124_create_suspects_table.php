<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suspects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('entryID');
            $table->string('name');
            $table->string('suspectNic');
            $table->string('suspectAddress');
            $table->string('OfficerName');
            $table->string('officerNic');
            $table->string('officerRole');
            $table->string('officerRank');

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
        Schema::dropIfExists('suspects');
    }
}
