@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-8 shadow-lg rounded-xl">
    <h2 class="text-2xl font-bold mb-6 text-indigo-700">Cadastrar Personagem</h2>

    <form action="{{ route('admin.characters.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Nome do Personagem</label>
            <input type="text" name="characterName" class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Ascendência</label>
            <input type="text" name="ancestry" class="w-full border border-gray-300 rounded-lg px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Tipo</label>
            <input type="text" name="type" class="w-full border border-gray-300 rounded-lg px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Vida</label>
            <input type="number" name="life" class="w-full border border-gray-300 rounded-lg px-3 py-2" min="0" value="0">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 mb-2">Imagem</label>
            <input type="file" name="imagem" accept="image/*" class="w-full border border-gray-300 rounded-lg px-3 py-2">
        </div>

        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg">
            Salvar Personagem
        </button>
    </form>
</div>
@endsection
