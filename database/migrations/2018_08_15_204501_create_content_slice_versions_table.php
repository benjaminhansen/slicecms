<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentSliceVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_slice_versions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('slice_id');
            $table->string('title');
            $table->string('uri');
            $table->longText('content');
            $table->integer('featured_media_id')->nullable();
            $table->integer('version_created_by_id');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('content_slice_versions');
    }
}
