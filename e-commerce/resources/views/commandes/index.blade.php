<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des Commandes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold my-4">Liste des Commandes</h1>

    @if(session('success'))
        <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-4">
        @foreach ($commandes as $commande)
            <div class="mb-4 border-b pb-4">
                <h2 class="text-xl font-bold mb-2">Commande #{{ $commande->id }}</h2>
                <ul>
                    @foreach ($commande->produits as $produit)
                        <li>{{ $produit->nom }} - {{ $produit->pivot->quantity }} x {{ $produit->prix }} €</li>
                    @endforeach
                </ul>
                <div class="mt-2">
                    <form action="{{ route('commandes.valider', $commande->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir valider cette commande ?')">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Valider
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
