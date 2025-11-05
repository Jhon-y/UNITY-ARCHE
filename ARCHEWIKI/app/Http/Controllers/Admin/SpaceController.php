<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Space;

class SpaceController extends Controller
{
    public function index()
    {
        $spaces = Space::all();
        return view('admin.spaces.index', compact('spaces'));
    }

    public function create()
    {
        return view('admin.spaces.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'imagem' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagem')) {
            $data['imagem'] = $request->file('imagem')->store('spaces', 'public');
        }

        Space::create($data);

        return redirect()->route('admin.spaces.index')->with('success', 'Espaço criado com sucesso!');
    }
}
