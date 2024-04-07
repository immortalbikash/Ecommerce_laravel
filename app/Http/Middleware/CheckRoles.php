<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //middleware kernel.php ma register garnu parcha
        // echo "<pre>";
        // print_r(User::ADMIN_ROLE);
        // exit;
        if(auth()->user()->role_id !== User::ADMIN_ROLE){
            return redirect()->route('home', [], 301);
        }


        return $next($request);
    }
}
