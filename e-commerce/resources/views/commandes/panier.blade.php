<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panier</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<!-- Top Bar -->
<header class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <img src="https://via.placeholder.com/150x50" alt="Kane & Frère" class="h-10 mr-4">
            <span class="text-2xl font-bold">Kane & Frère</span>
        </div>
        <div>
            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Se connecter
            </a>
        </div>
    </div>
</header>

<!-- Navigation Bar -->
<nav class="bg-gray-200 shadow-md">
    <div class="container mx-auto px-4 py-2 flex justify-between items-center">
        <ul class="flex space-x-4">
            <!-- Nav items -->
        </ul>
        <ul class="flex space-x-4">
            @foreach ($categories as $categorie)
                <li>
                    <a href="javascript:void(0)" class="text-gray-700 hover:text-gray-900 category-filter" data-id="{{ $categorie->id }}">{{ $categorie->nom }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>

<!-- Banner Image -->
<div class="container mx-auto px-4 mt-6">
    <img src="https://www.ddg-gastro.be/wp-content/uploads/2020/08/alimentation-saine.jpg" alt="Bannière" class="w-full h-500 object-cover rounded">
</div>

<!-- Main Content -->
<div class="container mx-auto px-4 mt-6">
    <h1 class="text-3xl font-bold my-4">Panier</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Produits Disponibles -->
    <h2 class="text-2xl font-bold mb-4">Produits Disponibles</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="products-container">
        @foreach ($produits as $produit)
            <div class="bg-white rounded-lg shadow-md p-4 product-item" data-category-id="{{ $produit->categorie_id }}">
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
                    <a href="{{ route('produits.details', $produit->id) }}" class="w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded block text-center">
                        Détails
                    </a>
                    <form action="{{ route('panier.ajouter', $produit->id) }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-cart-plus"></i> Ajouter au panier
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Panier et Confirmation de la Commande -->
    <h2 class="text-2xl font-bold my-4">Votre Panier</h2>
    @if(session('panier'))
        <div class="bg-white rounded-lg shadow-md p-4 mb-4">
            <ul>
                @foreach(session('panier') as $id => $details)
                    <li class="flex justify-between items-center mb-2">
                        <span>{{ $details['name'] }} - {{ $details['quantity'] }} x {{ $details['price'] }} €</span>
                        <form action="{{ route('panier.retirer', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
            <form action="{{ route('commande.confirmer') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Confirmer la commande
                </button>
            </form>
        </div>
    @else
        <p>Votre panier est vide.</p>
    @endif
</div>

<!-- Footer -->
<footer class="bg-gray-800 text-white mt-12 py-6">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">
            <p>&copy; {{ date('Y') }} Kane & Frère. Tous droits réservés.</p>
            <div class="flex space-x-4">
                <a href="#" class="text-white hover:underline">Mentions légales</a>
                <a href="#" class="text-white hover:underline">Contact</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoryLinks = document.querySelectorAll('.category-filter');
        const productsContainer = document.getElementById('products-container');
        const productItems = productsContainer.querySelectorAll('.product-item');

        categoryLinks.forEach(link => {
            link.addEventListener('click', function () {
                const categoryId = this.getAttribute('data-id');
                productItems.forEach(item => {
                    if (categoryId == 0 || item.getAttribute('data-category-id') == categoryId) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
</body>
</html>
