<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->increments('entryID');
            $table->string('complaintCategory');
            $table->string('complainantID');
            $table->string('complaint');
            $table->date('date');
            $table->date('district');
            $table->date('nearestPoliceStation');
            $table->date('progress');
            $table->date('crimeOffenceType');
            $table->date('suspects');
            $table->date('convict');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
}
