<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProduitController;
use App\Http\Controllers\Auth\RegisterController;

// Routes d'authentification
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Routes pour les utilisateurs authentifiés
Route::middleware('auth:web')->group(function () {
    Route::get('/profile', 'ProfileController@show')->name('profile');

    // Routes pour le panier
    Route::get('/panier', [CommandeController::class, 'afficherPanier'])->name('commande.panier');
    Route::post('/panier/ajouter/{id}', [CommandeController::class, 'ajouter'])->name('panier.ajouter');
    Route::delete('/panier/retirer/{id}', [CommandeController::class, 'retirer'])->name('panier.retirer');
    Route::post('/commande/confirmer', [CommandeController::class, 'confirmer'])->name('commande.confirmer');
    
    // Routes pour les commandes
    Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
    Route::patch('/commandes/{id}/valider', [CommandeController::class, 'valider'])->name('commandes.valider');
});

// Routes pour les produits (admin uniquement)
//Route::middleware(['auth:admin', 'is_admin'])->group(function () {
    Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
    Route::get('/produits/creer', [ProduitController::class, 'create'])->name('produits.creer');
    Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
    Route::get('/produits/{produit}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
    Route::put('/produits/{produit}', [ProduitController::class, 'update'])->name('produits.update');
    Route::delete('/produits/{produit}', [ProduitController::class, 'destroy'])->name('produits.destroy');
//});
