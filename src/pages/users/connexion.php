<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Page de Connexion</title>
    <!-- Inclure Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Connexion</h2>
        <form action="#" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="telephone">Numéro de téléphone</label>
                <input
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    type="tel" id="telephone" name="telephone" placeholder="Votre numéro de téléphone" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 mb-2" for="motdepasse">Mot de passe</label>
                <input
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    type="password" id="motdepasse" name="motdepasse" placeholder="Votre mot de passe" required>
            </div>
            <button class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-200"
                type="submit">Se connecter</button>
        </form>
    </div>
</body>

</html>