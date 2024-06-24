<?php
// app/Models/Produit.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = ['nom', 'prix', 'categorie_id', 'etat', 'image'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produit', 'produit_id', 'commande_id');
    }
}
