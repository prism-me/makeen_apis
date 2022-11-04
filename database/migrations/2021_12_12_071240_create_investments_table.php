<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->text('from');
            $table->text('to');
            $table->text('description');
            $table->text('completion_year');
            $table->text('summary');
            $table->string('email')->nullable();
            $table->string('ownership_type');
            $table->string('building_content');
            $table->string('amenities');
            $table->string('location');
            $table->string('area');
            $table->string('parking');
            $table->string('img');
            $table->string('alt_tag');
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
        Schema::dropIfExists('investments');
    }
}
