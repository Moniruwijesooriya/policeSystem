<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisteredCitizensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registered_citizens', function (Blueprint $table) {
            $table->string('name');
            $table->string('nic');
            $table->date('dob');
            $table->text('address');
            $table->integer('mobileNumber');
            $table->integer('landLineNumber');
            $table->string('civilStatus');
            $table->string('profession');
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
        Schema::dropIfExists('registered_citizens');
    }
}
