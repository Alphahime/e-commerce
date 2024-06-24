<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->float('montantTotal');
            $table->unsignedBigInteger('utilisateur_id');
            $table->timestamps();

            $table->foreign('utilisateur_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}
