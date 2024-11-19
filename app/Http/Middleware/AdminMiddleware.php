<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // تحقق من أن المستخدم هو أدمن
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request); // إذا كان المستخدم أدمن، استمر
        }

        return redirect('/'); // إذا لم يكن أدمن، إعادة توجيه إلى الصفحة الرئيسية
    }
}
