<?php

// app/Models/Commande.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = ['montantTotal', 'utilisateur_id'];

    public function utilisateur()
    {
        return $this->belongsTo(User::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit', 'commande_id', 'produit_id');
    }
}
