<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->integer('defindex')->unsigned()->index();
            $table->string('item_class');
            $table->string('item_type_name');
            $table->string('item_name');
            $table->string('item_description');
            $table->boolean('proper_name')->default(false);
            $table->smallInteger('item_quality');
            $table->string('item_inventory');
            $table->smallInteger('min_ilevel')->default(1);
            $table->smallInteger('max_ilevel')->default(1);
            $table->string('image_url')->nullable();
            $table->string('image_url_large')->nullable();
            $table->text('attributes')->nullable();
            $table->text('tool')->nullable();
            $table->text('capabilities')->nullable();
            $table->text('prices')->nullable();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }
}
