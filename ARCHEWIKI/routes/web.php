<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CharacterController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\SpaceController;

/*
|--------------------------------------------------------------------------
| 🔗 Redirecionamento inicial
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return session()->has('user')
        ? redirect()->route('index')
        : redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| 🔐 Autenticação
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 🌍 Áreas principais (usuário comum)
|--------------------------------------------------------------------------
*/
Route::get('/index', function () {
    if (!session()->has('user')) {
        return redirect()->route('login')->withErrors(['email' => 'Faça login primeiro.']);
    }
    return view('index', ['user' => session('user')]);
})->name('index');

Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');

Route::get('/saves', function () {
    if (!session()->has('user')) {
        return redirect()->route('login')->withErrors(['email' => 'Faça login primeiro.']);
    }
    return view('saves', ['user' => session('user')]);
})->name('saves');

/*
|--------------------------------------------------------------------------
| 🧩 Páginas públicas (listagem dos dados)
|--------------------------------------------------------------------------
*/
Route::get('/app/characters', [CharacterController::class, 'index'])->name('characters');
Route::get('/app/skills', [SkillController::class, 'index'])->name('skills');
Route::get('/app/spaces', [SpaceController::class, 'index'])->name('spaces');

// ----------------------
// 🧙‍♂️ Área do Admin
// ----------------------
Route::middleware(['admin'])->group(function () {

    // Painel principal do admin
    Route::get('/admin', function () {
        $user = session('user');
        return view('admin.index', compact('user'));
    })->name('admin.index');

    // Characters
    Route::get('/admin/characters', function () {
        return redirect()->route('admin.index'); // Redireciona para a página inicial do painel
    })->name('admin.characters.index');
    Route::get('/admin/characters/create', [CharacterController::class, 'create'])->name('admin.characters.create');
    Route::post('/admin/characters/store', [CharacterController::class, 'store'])->name('admin.characters.store');

    // Skills
    Route::get('/admin/skills', function () {
        return redirect()->route('admin.index'); // Redireciona para a página inicial do painel
    })->name('admin.skills.index');
    Route::get('/admin/skills/create', [SkillController::class, 'create'])->name('admin.skills.create');
    Route::post('/admin/skills/store', [SkillController::class, 'store'])->name('admin.skills.store');

    // Spaces
    Route::get('/admin/spaces', function () {
        return redirect()->route('admin.index'); // Redireciona para a página inicial do painel
    })->name('admin.spaces.index');
    Route::get('/admin/spaces/create', [SpaceController::class, 'create'])->name('admin.spaces.create');
    Route::post('/admin/spaces/store', [SpaceController::class, 'store'])->name('admin.spaces.store');
});
