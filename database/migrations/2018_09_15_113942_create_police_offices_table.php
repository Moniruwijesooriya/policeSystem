<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoliceOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('police_offices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('OfficeName');
            $table->string('district');
            $table->string('policeOfficeArea');
            $table->string('policeOfficeType');
            $table->string('landNumber');
            $table->string('mainOfficer');
            $table->string('headPoliceOffice');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('police_offices');
    }
}
