<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimezonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timezones', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('abbreviation')->nullable();
            $table->string('iana_time_zone_id');
            $table->string('utc_offset');
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
        Schema::dropIfExists('timezones');
    }
}
