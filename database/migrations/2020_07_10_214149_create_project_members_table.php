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
            $table->unsignedBigInteger('projects_id')->nullable();
            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('cascade');
            
            $table->unsignedBigInteger('team_members_id')->nullable();
            $table->foreign('team_members_id')->references('id')->on('team_members');

            $table->unsignedBigInteger('clients_id')->nullable();
            $table->foreign('clients_id')->references('id')->on('clients');

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
