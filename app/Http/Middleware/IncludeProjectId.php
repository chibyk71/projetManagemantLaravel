<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class IncludeProjectId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('projects/*') || $request->is('project/*')) {
            if ($request->route('project')) {
                Inertia::share('project_id', $request->route('project')->id);
                Inertia::share('project_title', $request->route('project')->title);
            }
        }
        return $next($request);
    }
}
