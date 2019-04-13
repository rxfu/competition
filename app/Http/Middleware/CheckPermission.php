<?php

namespace App\Http\Middleware;

use App\Exceptions\InvalidRequestException;
use App\Services\UserService;
use Auth;
use Closure;

class CheckPermission
{
    private $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->is_super) {
            $permission = $request->route()->getName();

            if (!$this->service->hasPermission(Auth::id(), $permission)) {
                abort(403);
                // throw new InvalidRequestException('权限不足，此操作需要' . $permission . '权限，请联系管理员', Auth::user(), 'check');
            }
        }

        return $next($request);
    }
}
