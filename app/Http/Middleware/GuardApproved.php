<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuardApproved
{
    public function handle(Request $request, Closure $next)
    {
        if (! auth()->user()->approved_at) {
            return redirect()->route('unapproved');
        }

        return $next($request);
    }
}
