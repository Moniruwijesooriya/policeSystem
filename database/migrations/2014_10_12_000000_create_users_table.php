<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('fullName');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nic')->unique();
            $table->date('dob')->nullable();
            $table->text('address');
            $table->string('mobileNumber')->nullable();
            $table->string('landLineNumber')->nullable();
            $table->string('gender');
            $table->string('civilStatus');
            $table->String('token');
            $table->string('profession');
            $table->string('policeOffice')->nullable();
            $table->string('verified');
            $table->rememberToken();
            $table->timestamps();
            $table->string('role');
            $table->string('blackListStatus');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
