<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    public function index(Request $request)
    {
        
        $query = Produit::with('categorie');
    
        if ($request->filled('etat')) {
            $query->where('etat', $request->etat);
        }
    
        $produits = $query->get();
    
        return view('produits.index', compact('produits'));
    }
    
    public function create()
    {
        $categories = Categorie::all();
        return view('produits.creer', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'prix' => 'required|numeric',
            'categorie_id' => 'required|exists:categories,id',
            'etat' => 'required|in:disponible,enStock,ruptureStock',
            'image' => 'nullable|image',
        ]);

        // Upload de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produits', 'public');
        } else {
            $imagePath = null;
        }

        Produit::create([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'categorie_id' => $request->categorie_id,
            'etat' => $request->etat,
            'image' => $imagePath,
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }

    public function edit(Produit $produit)
    {
        $categories = Categorie::all();
        return view('produits.edit', compact('produit', 'categories'));
    }

    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'nom' => 'required|string',
            'prix' => 'required|numeric',
            'categorie_id' => 'required|exists:categories,id',
            'etat' => 'required|in:disponible,enStock,ruptureStock',
            'image' => 'nullable|image',
        ]);

        // Upload de l'image si fournie
        if ($request->hasFile('image')) {
            Storage::delete($produit->image); // Suppression de l'ancienne image
            $imagePath = $request->file('image')->store('produits');
        } else {
            $imagePath = $produit->image;
        }

        $produit->update([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'categorie_id' => $request->categorie_id,
            'etat' => $request->etat,
            'image' => $imagePath,
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Produit $produit)
    {
        Storage::delete($produit->image); // Suppression de l'image associée
        $produit->delete();

        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
    }
    public function show($id)
{
    $produit = Produit::with('categorie')->findOrFail($id);
    return view('produits.show', compact('produit'));
}

public function details($id)
{
    $produit = Produit::with('categorie')->find($id);

    if (!$produit) {
        return redirect()->route('produits.index')->with('error', 'Produit non trouvé.');
    }

    return view('produits.details', compact('produit'));
}
}
