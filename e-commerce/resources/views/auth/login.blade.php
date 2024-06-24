<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded shadow-md max-w-4xl w-full">
            <h1 class="text-3xl font-bold mb-6 text-center">Connexion</h1>
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block mb-1">Email</label>
                    <input id="email" type="email" name="email" required autofocus class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label for="password" class="block mb-1">Mot de passe</label>
                    <input id="password" type="password" name="password" required class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Connexion</button>
                </div>
            </form>
            <div class="mt-4 text-center">
                <p>Vous n'avez pas de compte ? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">S'inscrire ici</a></p>
            </div>
        </div>
    </div>
</body>
</html>
