<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPuzzle
{
    public function handle(Request $request, Closure $next, int $neededPuzzle)
    {
        $currentPuzzle = session('gift_puzzle', 0);
        if ($currentPuzzle < $neededPuzzle) {
            return redirect('/puzzle/' . ($currentPuzzle + 1));
        }
        return $next($request);
    }
}
