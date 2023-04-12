<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Middlewares\PermissionMiddleware;

class Authorize extends PermissionMiddleware
{
    public function hasPermissionTo($permission)
    {
        return in_array($permission, Auth::user()->role->permissions->pluck('slug')->toArray());
    }
    public function handle($request, Closure $next, $permission, $guard = null)
    {
        if (!$this->hasPermissionTo($permission)) {
            return redirect('/index')->with('error', 'You are not authorised!');
        }
    }
}
