<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('teams_id');
            $table->foreign('teams_id')->references('id')->on('teams');

            $table->string('name');
            $table->string('email')->nullable();

            $table->string('timezone');
            $table->string('timezone_abbr');
            $table->string('start_hour')->nullable();
            $table->string('end_hour')->nullable();
            $table->text('avatar')->nullable();

            $table->boolean('is_activated')->default(false);
            $table->boolean('invited')->default(false);

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
        Schema::dropIfExists('team_members');
    }
}
