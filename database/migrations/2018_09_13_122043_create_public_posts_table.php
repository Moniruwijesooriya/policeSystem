<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_posts', function (Blueprint $table) {
            $table->increments('postId');
            $table->string('postedBy');
            $table->string('entryId');
            $table->string('title');
            $table->string('content');
            $table->string('provinceView');
            $table->string('districtView');
            $table->string('countryView');
            $table->string('postIdCount')->nullable();
            $table->string('excolumn1')->nullable();
            $table->string('excolumn2')->nullable();
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
        Schema::dropIfExists('public_posts');
    }
}
