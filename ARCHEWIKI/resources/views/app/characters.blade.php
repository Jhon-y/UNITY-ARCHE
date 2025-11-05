@extends('layouts.app')

@section('title', 'Personagens | Arché')

@section('content')
<div class="max-w-6xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-2xl">
    <h1 class="text-3xl font-bold text-indigo-700 mb-4">Seus Personagens</h1>
    <p class="text-gray-700 mb-6">Aqui você pode visualizar e gerenciar todos os personagens criados.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($characters as $c)
            <div class="border border-gray-200 rounded-xl p-4 shadow hover:shadow-md transition">
                @if($c->imagem)
                    <img src="{{ asset('storage/' . $c->imagem) }}"
                         alt="{{ $c->characterName }}"
                         class="w-full h-40 object-cover rounded mb-3">
                @endif

                <h2 class="text-xl font-semibold text-indigo-600">{{ $c->characterName }}</h2>
                <p class="text-gray-500">{{ $c->type ?? 'Sem tipo' }} • Vida: {{ $c->life ?? 0 }}</p>
                <button class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Ver Detalhes
                </button>
            </div>
        @empty
            <p class="text-gray-500 text-center col-span-full">Nenhum personagem encontrado.</p>
        @endforelse
    </div>
</div>
@endsection
