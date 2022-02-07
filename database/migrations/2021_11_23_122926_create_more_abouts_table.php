<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoreAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('more_abouts', function (Blueprint $table) {
            $table->id();
            $table->string('about_type');
            $table->string('title');
            $table->string('sub_title');
            $table->longText('description');
            $table->longText('featured_img')->nullable();
            $table->longText('city')->nullable();
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
        Schema::dropIfExists('more_abouts');
    }
}
