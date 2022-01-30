<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin;
use App\Models\Permission;

class AuthGates
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('admin');
        if($user)
        {
            $permissions = Permission::all();
            foreach($permissions as $key=>$permission)
            {
                Gate::define($permission->slug,function(Admin $admin) use($permission)
                {
                    return $admin->hasPermission($permission->slug);
                });
            }
        }
        return $next($request);
    }
}
