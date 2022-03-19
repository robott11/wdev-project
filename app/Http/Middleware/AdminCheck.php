<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('LoggedAdmin') && ($request->path() != 'admin/login')) {
            return redirect()->route('admin.login');
        }

        if (session()->has('LoggedAdmin') && ($request->path() == 'admin/login' || $request->path() == 'admin/register')) {
            return back();
        }

        return $next($request);
    }
}
