<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();
        if (!$user) {
            abort(403);
        }
        // Admin can access staff routes too, but platform cannot access tenant routes.
        if ($user->role === 'platform') {
            abort(403, 'Platform administrators cannot directly access tenant routes.');
        }

        $roles = [
            'admin' => 2,
            'staff' => 1,
        ];
        
        $userLevel = $roles[$user->role] ?? 0;
        $requiredLevel = $roles[$role] ?? 0;
        
        if ($userLevel < $requiredLevel) {
            abort(403);
        }
        return $next($request);
    }
}
