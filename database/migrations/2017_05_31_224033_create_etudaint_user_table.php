<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtudaintUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudiant_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('etudiant_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });

        Schema::table('etudiant_user', function (Blueprint $table) {
            $table->foreign('etudiant_id')->references('id')->on('etudiants')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('etudiant_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('etudiant_user', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['etudiant_id']);
        });

        Schema::dropIfExists('etudiant_user');
    }
}
