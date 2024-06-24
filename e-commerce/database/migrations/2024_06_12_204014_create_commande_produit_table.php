<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeProduitTable extends Migration
{
    public function up()
    {
        Schema::create('commande_produit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commande_id');
            $table->unsignedBigInteger('produit_id');
            $table->timestamps();

            $table->foreign('commande_id')->references('id')->on('commandes');
            $table->foreign('produit_id')->references('id')->on('produits');
        });
    }

    public function down()
    {
        Schema::dropIfExists('commande_produit');
    }
}
