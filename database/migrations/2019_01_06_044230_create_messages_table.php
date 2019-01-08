<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('message');
            $table->string('senderNic');
            $table->string('receiverNic');
            $table->string('adminNotification');
            $table->string('citizenNotification');
            $table->string('boicNotification');
            $table->string('oicNotification');
            $table->string('doigNotification');
            $table->string('igpNotification');
            $table->string('exColumn1')->nullable();
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
        Schema::dropIfExists('messages');
    }
}
