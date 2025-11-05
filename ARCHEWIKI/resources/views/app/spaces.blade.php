@extends('layouts.app')

@section('title', 'Espaços | Arché')

@section('content')
<div class="max-w-6xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-2xl">
    <h1 class="text-3xl font-bold text-indigo-700 mb-4">Espaços</h1>
    <p class="text-gray-700 mb-6">Explore os diferentes espaços e ambientes do mundo de Arché.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($spaces as $s)
            <div class="border border-gray-200 rounded-xl p-4 shadow hover:shadow-md transition">
                @if($s->imagem)
                    <img src="{{ asset('storage/' . $s->imagem) }}"
                         alt="{{ $s->spaceName }}"
                         class="w-full h-40 object-cover rounded mb-3">
                @endif

                <h2 class="text-xl font-semibold text-indigo-600">{{ $s->spaceName }}</h2>
                <p class="text-gray-500">{{ $s->description ?? 'Sem descrição.' }}</p>
                <button class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Entrar
                </button>
            </div>
        @empty
            <p class="text-gray-500 text-center col-span-full">Nenhum espaço cadastrado.</p>
        @endforelse
    </div>
</div>
@endsection
