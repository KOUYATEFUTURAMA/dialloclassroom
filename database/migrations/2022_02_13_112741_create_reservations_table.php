<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('cours_id');
            $table->bigInteger('amount');
            $table->string('payment_method');
            $table->text('description');
            $table->string('operator_id');
            $table->dateTime('payment_date');
            $table->string('name_costumer')->nullable();
            $table->string('email_costumer')->nullable();
            $table->string('contact_costumer')->nullable();
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
        Schema::dropIfExists('reservations');
    }
}
