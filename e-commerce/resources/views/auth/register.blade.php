<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded shadow-md max-w-md w-full">
            <h1 class="text-3xl font-bold mb-6 text-center">Inscription</h1>
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block mb-1">Nom</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                    @error('name')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                    @error('email')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block mb-1">Mot de passe</label>
                    <input id="password" type="password" name="password" required class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                    @error('password')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block mb-1">Confirmation du mot de passe</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
