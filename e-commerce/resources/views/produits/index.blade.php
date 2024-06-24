<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des Produits</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold my-4">Liste des Produits</h1>

    @if (session('success'))
        <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/4 p-4 bg-white rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Filtres</h2>
            <form action="{{ route('produits.index') }}" method="GET">
                <div class="mb-4">
                    <label for="etat" class="block text-gray-700">Disponibilité</label>
                    <select name="etat" id="etat" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        <option value="">Tous</option>
                        <option value="disponible">Disponible</option>
                        <option value="enStock">En stock</option>
                        <option value="ruptureStock">Rupture de stock</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
            </form>
        </div>

        <!-- Products List -->
        <div class="w-3/4 ml-4">
            <a href="{{ route('produits.creer') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
                <i class="fas fa-plus"></i> Ajouter un produit
            </a>
            <a href="{{ route('produits.index') }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4">
                <i class="fas fa-list"></i> Voir les commandes
            </a>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($produits as $produit)
                    <div class="bg-white rounded-lg shadow-md p-4">
                        @if ($produit->image)
                            <img src="{{ asset('storage/' . $produit->image) }}" class="w-full h-48 object-cover rounded-t-lg" alt="{{ $produit->nom }}">
                        @else
                            <div class="text-center py-4">Aucune image</div>
                        @endif
                        <div class="p-4">
                            <h5 class="text-xl font-bold">{{ $produit->nom }}</h5>
                            <p class="text-gray-700">Prix: {{ $produit->prix }} €</p>
                            <p class="text-gray-700">Catégorie: {{ $produit->categorie->nom }}</p>
                            <p class="text-gray-700">État: {{ $produit->etat }}</p>
                            <div class="flex justify-between items-center mt-4">
                                <a href="{{ route('produits.edit', $produit->id) }}" class="text-blue-500 hover:underline">Modifier</a>
                                <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

</body>
</html>
