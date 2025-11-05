<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    // 🧩 Exibe a lista de habilidades
    public function index()
    {
        $skills = Skill::all();
        return view('app.skills', compact('skills'));
    }

    // 🪄 Mostra o formulário de criação
    public function create()
    {
        return view('admin.skills.create');
    }

    // 💾 Armazena nova habilidade no banco
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:45',
            'type' => 'required|string|max:45',
            'effect' => 'nullable|string|max:45',
            'imagem' => 'nullable|image|max:2048',
        ]);

        $skill = new Skill();
        $skill->description = $request->description;
        $skill->type = $request->type;
        $skill->effect = $request->effect;

        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('skills', 'public');
            $skill->imagem = $path;
        }

        $skill->save();

        return redirect()->route('admin.skills.index')
            ->with('success', 'Habilidade cadastrada com sucesso!');
    }

}
