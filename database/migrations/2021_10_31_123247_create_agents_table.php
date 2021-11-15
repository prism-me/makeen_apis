<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            
            $table->string('mk_company_name');
            $table->string('mk_trade_license_number')->nullable();
            $table->string('mk_trade_license_file')->nullable();
            $table->string('mk_rera_orn_number')->nullable();
            $table->string('mk_rera_orn_file')->nullable();
            $table->string('mk_broker_id')->nullable();
            $table->string('mk_broker_name')->nullable();
            $table->string('mk_area_specialty')->nullable();
            $table->string('mk_phone')->nullable();
            $table->string('mk_email')->nullable();
            $table->string('mk_noc_file')->nullable();
            $table->string('is_pushed');            
            $table->string('flag');            
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
        Schema::dropIfExists('news');
    }
}
