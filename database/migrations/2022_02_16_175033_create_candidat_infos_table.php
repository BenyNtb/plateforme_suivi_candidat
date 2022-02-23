<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidat_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidat_id');
            $table->boolean('pc');
            $table->string('statut');
            $table->integer('phone');
            $table->string('adresse');
            $table->string('commune');
            $table->date('date_naissance');
            $table->text('parcours');
            $table->text('motivation');
            $table->text('objectif');
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
        Schema::dropIfExists('candidat_infos');
    }
}
