<?php

namespace App\Http\Middleware;

use App\Blog;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $email = $request->session()->get('email');
        if (!$email || !$blog = Blog::query()
                ->where('email', $email)
                ->where('status', 1)
                ->latest()
                ->first()
        ) {
            return redirect(url('/profile/login.html'));
        }

        $request->blog = $blog;

        return $next($request);
    }
}
