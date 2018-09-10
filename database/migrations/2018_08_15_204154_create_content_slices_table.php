<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentSlicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_slices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id');
            $table->integer('created_by_id');
            $table->integer('last_updated_by_id');
            $table->string('title');
            $table->string('uri');
            $table->longText('content');
            $table->integer('featured_media_id')->nullable();
            $table->integer('published');
            $table->integer('publish_later');
            $table->datetime('publish_at')->nullable();
            $table->integer('content_slice_type_id');
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
        Schema::dropIfExists('content_slices');
    }
}
