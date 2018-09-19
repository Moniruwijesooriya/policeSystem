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
            $table->string('district');
            $table->string('nearestPoliceStation');
            $table->string('oicNotification');
            $table->string('boicNotification');
            $table->string('progress')->nullable();
            $table->string('branch')->nullable();
            $table->string('suspects')->nullable();
            $table->string('convicts')->nullable();
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
        Schema::dropIfExists('entries');
    }
}
