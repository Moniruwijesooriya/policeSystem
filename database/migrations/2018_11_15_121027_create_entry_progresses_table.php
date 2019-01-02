<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntryProgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entry_progresses', function (Blueprint $table) {
            $table->string('entryID');
            $table->string('progress');
            $table->string('policeOfficerName');
            $table->string('officerNic');
            $table->string('rank');
            $table->string('policeOffice');
            $table->string('role');
            $table->string('citizenView');
            $table->string('policeView');
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
        Schema::dropIfExists('entry_progresses');
    }
}
