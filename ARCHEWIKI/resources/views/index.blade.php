<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arché | Início</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">

    {{-- Inclui o header --}}
    @include('layouts.header', ['user' => $user])

    <main class="max-w-6xl mx-auto mt-10 px-6">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h1 class="text-3xl font-semibold text-indigo-700 mb-6">Bem-vindo, {{ $user->name }}!</h1>
            <p class="text-gray-700 text-lg">Escolha uma das seções abaixo para continuar explorando seu mundo em Arché.</p>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 border rounded-xl hover:shadow-lg transition cursor-pointer">
                    <h2 class="text-xl font-bold text-indigo-600 mb-2">Espaços</h2>
                    <p class="text-gray-600">Visualize locais e ambientes do universo Arché.</p>
                </div>

                <div class="p-6 border rounded-xl hover:shadow-lg transition cursor-pointer">
                    <h2 class="text-xl font-bold text-indigo-600 mb-2">Personagens</h2>
                    <p class="text-gray-600">Visualize os personagens não jogáveis que estão no jogo.</p>
                </div>

                <div class="p-6 border rounded-xl hover:shadow-lg transition cursor-pointer">
                    <h2 class="text-xl font-bold text-indigo-600 mb-2">Habilidades</h2>
                    <p class="text-gray-600">Visualize as habilidades que se é possivel obter ao jogar esse jogo</p>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
