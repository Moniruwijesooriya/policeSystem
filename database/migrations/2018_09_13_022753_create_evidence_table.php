<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvidenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidence', function (Blueprint $table) {
            $table->increments('evidenceId');
            $table->string('entryID');
            $table->string('witnessId');
            $table->text('evidence_txt')->nullable();
            $table->string('evidence_image')->nullable();
            $table->string('evidence_video')->nullable();
            $table->string('citizenView');
            $table->string('policeView');
            $table->string('evidence_image_count')->nullable();
            $table->string('evidence_video_count')->nullable();
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
        Schema::dropIfExists('evidence');
    }
}
