<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuardAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('unapproved');
        }

        return $next($request);
    }
}
