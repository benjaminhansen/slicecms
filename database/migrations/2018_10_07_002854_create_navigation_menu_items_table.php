<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation_menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('navigation_menu_id');
            $table->integer('order');
            $table->integer('parent_id')->nullable();
            $table->string('name');
            $table->string('title');
            $table->string('href');
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
        Schema::dropIfExists('navigation_menu_items');
    }
}
