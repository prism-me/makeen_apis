<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('department');
            $table->string('name');
            $table->string('type');
            $table->string('img')->nullable();
            $table->string('designation');
            $table->string('location');
            $table->string('language');
            $table->string('experience');
            $table->string('alt_tag')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('linkdin')->nullable();
            $table->string('instagram')->nullable();
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
        Schema::dropIfExists('teams');
    }
}
