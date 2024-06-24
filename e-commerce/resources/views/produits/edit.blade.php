<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modifier Produit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Modifier Produit</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('produits.update', $produit->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" class="form-control" id="nom" value="{{ old('nom', $produit->nom) }}" required>
            </div>

            <div class="form-group">
                <label for="prix">Prix</label>
                <input type="number" name="prix" class="form-control" id="prix" value="{{ old('prix', $produit->prix) }}" required>
            </div>

            <div class="form-group">
                <label for="categorie_id">Catégorie</label>
                <select name="categorie_id" class="form-control" id="categorie_id" required>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}" {{ $produit->categorie_id == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="etat">État</label>
                <select name="etat" class="form-control" id="etat" required>
                    <option value="disponible" {{ $produit->etat == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="enStock" {{ $produit->etat == 'enStock' ? 'selected' : '' }}>En stock</option>
                    <option value="ruptureStock" {{ $produit->etat == 'ruptureStock' ? 'selected' : '' }}>Rupture de stock</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                @if ($produit->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" class="img-thumbnail" width="200">
                    </div>
                @endif
                <input type="file" name="image" class="form-control-file" id="image">
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>

        <a href="{{ route('produits.index') }}" class="btn btn-secondary mt-3">Retour à la liste des produits</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
