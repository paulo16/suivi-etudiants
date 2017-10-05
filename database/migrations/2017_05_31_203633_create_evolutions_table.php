<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evolutions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('situation')->nullable();
            $table->unsignedInteger('annee')->nullable();
            $table->string('niveau')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('etablissement_id')->nullable();
            $table->unsignedInteger('filiere_id')->nullable();
            $table->unsignedInteger('ville_id')->nullable();
            $table->unsignedInteger('etudiant_id');
            $table->timestamps();
        });

        Schema::table('evolutions', function (Blueprint $table) {
            $table->foreign('etablissement_id')->references('id')->on('etablissements')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('evolutions', function (Blueprint $table) {
            $table->foreign('filiere_id')->references('id')->on('filieres')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('evolutions', function (Blueprint $table) {
            $table->foreign('ville_id')->references('id')->on('villes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('evolutions', function (Blueprint $table) {
            $table->foreign('etudiant_id')->references('id')->on('etudiants')
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
        Schema::table('evolutions', function (Blueprint $table) {
            $table->dropForeign(['etablissement_id']);
            $table->dropForeign(['ville_id']);
            $table->dropForeign(['filiere_id']);
            $table->dropForeign(['etudiant_id']);
        });

        Schema::dropIfExists('evolutions');
    }
}
