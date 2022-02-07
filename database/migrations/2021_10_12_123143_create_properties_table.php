<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('location_id')->nullable();
            $table->string('category_type');
            $table->string('Property_type');
            $table->string('featured_image')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('gallery_images')->nullable();
            $table->string('floor_plan_images')->nullable();
            $table->string('video_images')->nullable();
            $table->string('images_360')->nullable();
            $table->text('short_content');
            $table->text('long_description');
            $table->string('amenities')->nullable();
            $table->string('slug')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('meta_index')->nullable();
            $table->boolean('meta_follow')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('properties');
    }
}
