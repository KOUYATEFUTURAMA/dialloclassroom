<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
            $table->string('libelle_cours');
            $table->integer('mode_id');
            $table->integer('categorie_id');
            $table->integer('duree');
            $table->bigInteger('prix');
            $table->text('description');
            $table->integer('nombre_place')->default(0);
            $table->string('video_descriptive')->nullable();
            $table->string('image_descriptive')->nullable();
            $table->string('image_descriptive_slider')->nullable();
            $table->string('video_cours')->nullable();
            $table->integer('enseignant_id')->nullable();
            $table->dateTime('date_cours')->nullable();
            $table->dateTime('date_publication')->nullable();
            $table->boolean('en_vedette')->default(0);
            $table->boolean('publier')->default(0);
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
        Schema::dropIfExists('cours');
    }
}
