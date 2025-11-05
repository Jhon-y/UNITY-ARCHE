<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Arché</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white shadow-2xl rounded-2xl p-8 w-96">
        <h1 class="text-2xl font-bold text-center mb-6 text-indigo-600">Arché - Login</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="email">Email</label>
                <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 mb-2" for="password">Senha</label>
                <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400" required>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                Entrar
            </button>
        </form>

        <p class="text-center text-gray-600 mt-4">
            Não tem uma conta?
            <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Cadastre-se</a>
        </p>
    </div>

</body>
</html>
