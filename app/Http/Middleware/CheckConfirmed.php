<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckConfirmed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->is_confirmed) {
            switch (Auth::user()->role_id) {
                case config('setting.manager'):
                    $route = 'user.confirm';
                    break;

                case config('setting.marker'):
                    $route = 'marker.confirm';
                    break;

                case config('setting.player'):
                    $route = 'player.confirm';
                    break;

                default:
                    $route = 'user.confirm';
            }

            return redirect()->route($route, Auth::id());
        }

        return $next($request);
    }
}
