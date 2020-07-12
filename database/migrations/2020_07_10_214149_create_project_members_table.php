<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project')->nullable();
            $table->foreign('project')->references('id')->on('projects');
            
            $table->unsignedBigInteger('team_member')->nullable();
            $table->foreign('team_member')->references('id')->on('team_members');

            $table->unsignedBigInteger('client')->nullable();
            $table->foreign('client')->references('id')->on('clients');

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
        Schema::dropIfExists('project_members');
    }
}
