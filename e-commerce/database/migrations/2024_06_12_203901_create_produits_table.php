<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->float('prix');
            $table->unsignedBigInteger('categorie_id');
            $table->enum('etat', ['disponible', 'enStock', 'ruptureStock'])->default('disponible');
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('categorie_id')->references('id')->on('categories');
        });
    }

    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
