<header class="bg-indigo-700 text-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo / Nome -->
        <div class="flex items-center space-x-3">
            <a href="{{ route('index') }}" class="text-2xl font-bold tracking-wide hover:text-indigo-200 transition">
                Arché
            </a>
        </div>

        <!-- Navegação desktop -->
        <nav class="hidden md:flex space-x-8 text-lg">
            <a href="{{ route('spaces') }}" class="hover:text-indigo-200 transition">Espaços</a>
            <a href="{{ route('characters') }}" class="hover:text-indigo-200 transition">Personagens</a>
            <a href="{{ route('skills') }}" class="hover:text-indigo-200 transition">Habilidades</a>
        </nav>

        <!-- Perfil + Logout -->
        <div class="flex items-center space-x-4">
            <a href="{{ route('profile') }}" class="flex items-center space-x-2 hover:text-indigo-200 transition">
                <i data-lucide="user-circle" class="w-8 h-8"></i>
                <span class="hidden sm:inline">
                    {{ session('user')->name ?? 'Usuário' }}
                </span>
            </a>

            <form action="{{ route('logout') }}" method="POST" class="hidden sm:block">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1.5 rounded-lg text-sm font-semibold transition">
                    Sair
                </button>
            </form>

            <!-- Botão menu mobile -->
            <button id="menu-toggle" class="md:hidden focus:outline-none">
                <i data-lucide="menu" class="w-8 h-8"></i>
            </button>
        </div>
    </div>

    <!-- Menu mobile -->
    <nav id="mobile-menu" class="hidden flex-col bg-indigo-800 md:hidden px-6 pb-4 space-y-2 text-lg">
        <a href="{{ route('index') }}" class="block hover:text-indigo-200 transition">Espaços</a>
        <a href="{{ route('saves') }}" class="block hover:text-indigo-200 transition">Saves</a>
        <a href="{{ route('characters') }}" class="block hover:text-indigo-200 transition">Personagens</a>
        <a href="{{ route('skills') }}" class="block hover:text-indigo-200 transition">Habilidades</a>

        <hr class="border-indigo-600">
        <a href="{{ route('profile') }}" class="flex items-center space-x-2 hover:text-indigo-200 transition">
            <i data-lucide="user-circle" class="w-6 h-6"></i>
            <span>{{ session('user')->name ?? 'Perfil' }}</span>
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full text-left bg-red-500 hover:bg-red-600 px-3 py-2 rounded-lg font-semibold transition">
                Sair
            </button>
        </form>
    </nav>
</header>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();

    // Alternar menu mobile
    document.getElementById('menu-toggle').addEventListener('click', function () {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
