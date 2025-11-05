<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfile()
    {
        if (!session()->has('user')) {
            return redirect()->route('login')->withErrors(['email' => 'Faça login primeiro.']);
        }

        return view('profile', ['user' => session('user')]);
    }
}
