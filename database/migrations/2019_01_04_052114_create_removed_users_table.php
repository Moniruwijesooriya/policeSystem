<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemovedUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('removed_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('fullName');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at');
            $table->string('nic')->unique();
            $table->date('dob');
            $table->text('address');
            $table->string('mobileNumber');
            $table->string('landLineNumber');
            $table->string('gender');
            $table->string('civilStatus');
            $table->string('profession');
            $table->string('policeOffice');
            $table->string('role');
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
        Schema::dropIfExists('removed_users');
    }
}
