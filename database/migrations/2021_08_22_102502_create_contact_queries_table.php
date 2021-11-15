<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_queries', function (Blueprint $table) {
            $table->id();
            $table->string('mk_name');
            $table->string('mk_email');
            $table->string('mk_phone');
            $table->string('mk_property_category');
            $table->string('mk_property_type');
            $table->string('mk_message');
            $table->string('mk_flag');
            $table->string('is_pushed');
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
        Schema::dropIfExists('contact_queries');
    }
}
