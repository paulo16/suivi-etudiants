<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtudiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudiants',function (Blueprint $table){
            $table->increments('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->nullable();
            $table->string('tel')->nullable();
            $table->date('date_naissance')->nullable()->default(null);
            $table->string('status')->nullable();
            $table->string('promotion')->nullable();
            $table->string('genre')->nullable();
            $table->string('adresse')->nullable();
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
        Schema::drop('etudiants');
    }
}
