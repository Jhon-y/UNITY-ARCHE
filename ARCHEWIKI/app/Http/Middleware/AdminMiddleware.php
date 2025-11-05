<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = session('user');

        if (!$user || $user->tipo !== 'admin') {
            return redirect()->route('index')->withErrors(['Acesso negado.']);
        }

        return $next($request);
    }
}
