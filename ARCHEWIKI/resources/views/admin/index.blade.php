@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 text-center">
    <h1 class="text-3xl font-bold text-indigo-700 mb-6">Painel do Administrador</h1>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <a href="{{ route('admin.spaces.create') }}" class="bg-indigo-600 text-white py-4 rounded-lg hover:bg-indigo-700 transition">Cadastrar Espaço</a>
        <a href="{{ route('admin.characters.create') }}" class="bg-indigo-600 text-white py-4 rounded-lg hover:bg-indigo-700 transition">Cadastrar Personagem</a>
        <a href="{{ route('admin.skills.create') }}" class="bg-indigo-600 text-white py-4 rounded-lg hover:bg-indigo-700 transition">Cadastrar Habilidade</a>
    </div>
</div>
@endsection
