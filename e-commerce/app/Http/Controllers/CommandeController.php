<?php
namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Commande;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function afficherPanier()
    {
        $categories = Categorie::all();
        $produits = Produit::all(); // Affiche tous les produits par défaut

        return view('commandes.panier', compact('produits', 'categories'));
    }

    public function ajouter(Request $request, $id)
    {
        $produit = Produit::find($id);

        if (!$produit) {
            return redirect()->back()->with('error', 'Produit non trouvé.');
        }

        $panier = session()->get('panier', []);

        if (isset($panier[$id])) {
            $panier[$id]['quantity']++;
        } else {
            $panier[$id] = [
                "name" => $produit->nom,
                "quantity" => 1,
                "price" => $produit->prix,
                "image" => $produit->image
            ];
        }

        session()->put('panier', $panier);
        return redirect()->route('commande.panier')->with('success', 'Produit ajouté au panier.');
    }

    public function retirer(Request $request, $id)
    {
        $panier = session()->get('panier');

        if (isset($panier[$id])) {
            unset($panier[$id]);
            session()->put('panier', $panier);
        }

        return redirect()->route('commande.panier')->with('success', 'Produit retiré du panier.');
    }

    public function confirmer()
    {
        session()->forget('panier');
        return redirect()->route('commande.panier')->with('success', 'Commande confirmée.');
    }

    public function index()
    {
        $commandes = Commande::with('produits')->get();
        return view('commandes.index', compact('commandes'));
    }

    public function valider($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->status = 'validée';
        $commande->save();

        return redirect()->route('commandes.index')->with('success', 'Commande validée avec succès.');
    }
}
