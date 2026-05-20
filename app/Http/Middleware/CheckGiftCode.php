<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckGiftCode
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('gift_code_ok')) {
            return redirect('/');
        }
        return $next($request);
    }
}
