<?php

namespace App\Http\Middleware;

  
use Closure;
use Illuminate\Http\Request;
use Auth;
use Cache;
use App\Models\Log;
use App\Models\User;

class UserActivity
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
        if (Auth::check()) {  
            $expiresAt = now()->addMinutes(2); /* keep online for 2 min */
            Cache::put('user-is-online-' . Auth::user()->uID, true, $expiresAt);
  
            /* last seen */
            User::where('uID', Auth::user()->uID)->update(['user_activity' => now()]);
        }
        return $next($request);
    }
}
