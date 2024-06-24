<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un produit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Créer un produit</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nom">Nom du produit</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
        </div>

        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" step="0.01" class="form-control" id="prix" name="prix" value="{{ old('prix') }}" required>
        </div>

        <div class="form-group">
            <label for="categorie_id">Catégorie</label>
            <select class="form-control" id="categorie_id" name="categorie_id" required>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="etat">État</label>
            <select class="form-control" id="etat" name="etat" required>
                <option value="disponible" {{ old('etat') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="enStock" {{ old('etat') == 'enStock' ? 'selected' : '' }}>En Stock</option>
                <option value="ruptureStock" {{ old('etat') == 'ruptureStock' ? 'selected' : '' }}>Rupture de Stock</option>
            </select>
        </div>

        <div class="form-group">
            <label for="image">Image du produit</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Ajouter le produit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
