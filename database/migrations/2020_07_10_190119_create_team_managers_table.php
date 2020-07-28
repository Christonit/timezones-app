<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_managers', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('teams_id');
            $table->foreign('teams_id')->references('id')->on('teams');
            
            $table->unsignedBigInteger('managers_id');
            $table->foreign('managers_id')->references('id')->on('users');
            
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
        Schema::dropIfExists('team_managers');
    }
}
