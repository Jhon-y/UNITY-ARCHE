<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Character;

class CharacterController extends Controller
{
    public function index()
    {
        $characters = Character::all();
        return view('admin.characters.index', compact('characters'));
    }

    public function create()
    {
        return view('admin.characters.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'characterName' => 'required|string|max:255',
            'ancestry' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'life' => 'nullable|integer',
            'imagem' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagem')) {
            $data['imagem'] = $request->file('imagem')->store('characters', 'public');
        }

        Character::create($data);

        return redirect()->route('admin.characters.index')->with('success', 'Personagem criado com sucesso!');
    }
}
