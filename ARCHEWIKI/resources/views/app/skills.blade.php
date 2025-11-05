@extends('layouts.app')

@section('title', 'Habilidades | Arché')

@section('content')
<div class="max-w-6xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-2xl">
    <h1 class="text-3xl font-bold text-indigo-700 mb-4">Habilidades</h1>
    <p class="text-gray-700 mb-6">Lista de todas as habilidades conhecidas e suas descrições.</p>

    <div class="space-y-4">
        @forelse($skills as $s)
            <div class="border border-gray-200 rounded-xl p-4 shadow hover:shadow-md transition">
                @if($s->imagem)
                    <img src="{{ asset('storage/' . $s->imagem) }}"
                         alt="{{ $s->skillName }}"
                         class="w-full h-40 object-cover rounded mb-3">
                @endif

                <h2 class="text-xl font-semibold text-indigo-600">{{ $s->skillName }}</h2>
                <p class="text-gray-500">Tipo: {{ $s->type ?? 'Desconhecido' }}</p>
                <p class="text-gray-600 mt-2">{{ $s->description ?? 'Sem descrição.' }}</p>
            </div>
        @empty
            <p class="text-gray-500 text-center">Nenhuma habilidade cadastrada.</p>
        @endforelse
    </div>
</div>
@endsection
