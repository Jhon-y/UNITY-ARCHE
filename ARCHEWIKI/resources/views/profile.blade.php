@extends('layouts.app')

@section('content')

    <div class="max-w-4xl mx-auto mt-10 bg-white rounded-xl shadow p-8">
        <h1 class="text-3xl font-bold text-indigo-700 mb-6">Informações do Perfil</h1>

        <div class="space-y-4">
            <p><strong>Nome:</strong> {{ $user->name ?? '—' }}</p>
            <p><strong>Email:</strong> {{ $user->email ?? '—' }}</p>
        </div>

        <div class="mt-8">
            <a href="{{ route('index') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                Voltar
            </a>
        </div>
    </div>
@endsection
