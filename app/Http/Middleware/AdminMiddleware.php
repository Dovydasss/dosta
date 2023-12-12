<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
// AdminMiddleware.php

public function handle(Request $request, Closure $next)
{
    $adminRole = Role::where('name', 'admin')->first();

    if (Auth::check() && Auth::user()->hasRole($adminRole)) {
  
        return $next($request);
    }

    abort(403, 'Unauthorized'); 
}


}