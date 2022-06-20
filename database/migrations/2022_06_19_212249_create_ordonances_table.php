<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordonances', function (Blueprint $table) {
            $table->id();
            $table->integer('etat');
            $table->unsignedBigInteger('patient');
            $table->foreign('patient')->references('id')->on('patients')->onDelete('cascade');
            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('facture');
            $table->foreign('facture')->references('id')->on('factures')->onDelete('cascade');
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
        Schema::dropIfExists('ordonances');
    }
};