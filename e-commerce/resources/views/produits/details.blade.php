<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Détails du Produit</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 mt-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $produit->nom }}</h1>
            @if ($produit->image)
                <img src="{{ asset('storage/' . $produit->image) }}" class="w-full h-64 object-cover rounded" alt="{{ $produit->nom }}">
            @else
                <div class="text-center py-4">Aucune image</div>
            @endif
            <p class="text-gray-700 mt-4">Prix: {{ $produit->prix }} €</p>
            <p class="text-gray-700 mt-2">Catégorie: {{ $produit->categorie->nom }}</p>
            <p class="text-gray-700 mt-2">État: {{ $produit->etat }}</p>
            <p class="text-gray-700 mt-2">Description: {{ $produit->description }}</p>
            <a href="{{ route('commande.panier') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Retour au panier</a>
        </div>
    </div>
</body>
</html>
