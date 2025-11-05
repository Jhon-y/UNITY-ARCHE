<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arché</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    @include('layouts.header')

    <main class="flex-1">
        @yield('content')
    </main>
    @if(session('user') && session('user')->tipo === 'admin')
        <!-- Botão flutuante admin -->
        <div class="fixed bottom-4 right-4 z-50">
            <div class="relative group">
                <!-- Botão principal -->
                <button id="admin-fab"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-5 rounded-full shadow-lg text-2xl transition transform hover:scale-110 focus:outline-none">
                    +
                </button>

                <!-- Menu oculto -->
                <div id="admin-fab-menu"
                    class="absolute bottom-16 right-0 flex flex-col space-y-2 bg-white shadow-lg rounded-lg p-2 opacity-0 scale-90 transform transition-all duration-200 pointer-events-none group-hover:opacity-100 group-hover:scale-100">

                    <a href="{{ route('admin.characters.create') }}"
                    class="block px-4 py-2 rounded hover:bg-indigo-600 hover:text-white transition">
                        Cadastrar Character
                    </a>
                    <a href="{{ route('admin.skills.create') }}"
                    class="block px-4 py-2 rounded hover:bg-indigo-600 hover:text-white transition">
                        Cadastrar Skill
                    </a>
                    <a href="{{ route('admin.spaces.create') }}"
                    class="block px-4 py-2 rounded hover:bg-indigo-600 hover:text-white transition">
                        Cadastrar Space
                    </a>
                </div>
            </div>
        </div>

        <script>
            const fab = document.getElementById('admin-fab');
            const menu = document.getElementById('admin-fab-menu');

            fab.addEventListener('click', () => {
                // Toggle menu visibility
                menu.classList.toggle('opacity-100');
                menu.classList.toggle('scale-100');
                menu.classList.toggle('pointer-events-auto');
            });

            // Fecha o menu se clicar fora
            document.addEventListener('click', (e) => {
                if (!fab.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                }
            });
        </script>
    @endif


</body>
</html>
