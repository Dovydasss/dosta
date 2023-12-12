<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\PageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class LoadPageSettings
{
    public function handle($request, Closure $next)
    {
        $settings = PageSetting::first();
        View::share('pageSettings', $settings);
        return $next($request);
    }
}
