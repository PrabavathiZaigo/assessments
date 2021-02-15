<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class IsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,...$role)
    {
       /* if (auth()->user()->role_id == config('roles.role.manager'))
        {
            return redirect('managers.index');
        }
        return $next($request);
    }*/
    if (!Auth::check()) // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
        return redirect('login');

    $user = Auth::user()->role_id;

    if($user == config('roles.role.manager'))
    return $next($request);

    foreach($role as $role) {
        // Check if user has the role This check will depend on how your roles are set up
        if($user->hasRole($role)){
            return $next($request);
        }
        
        $array = [
            'managers.index',
            'managers.create',

        ];
       
        return redirect(route($array[Auth()::user()->role_id]));
        
        
    }

    return redirect('login');
}
}
