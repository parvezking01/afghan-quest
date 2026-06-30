<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApproved
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'hotel_owner' && !auth()->user()->is_approved) {
            auth()->logout();
            return redirect()->route('login')
                ->with('error', 'اکانت شما هنوز تایید نشده است. لطفاً منتظر تایید مدیر باشید.');
        }

        return $next($request);
    }
}
