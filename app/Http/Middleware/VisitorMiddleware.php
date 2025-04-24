<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class VisitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if ($request->is('api/*')) {
        //     return $next($request);
        // }

        // // Menyimpan data pengunjung ke dalam tabel visitors
        // DB::table('visitors')->insert([
        //     'ip_address' => $request->ip(),  // IP pengunjung
        //     'user_agent' => $request->header('User-Agent'),  // Informasi perangkat dan browser
        //     'user_id' => Auth::check() ? Auth::id() : null,  // ID user jika login
        //     'visited_at' => now(),  // Waktu kunjungan
        // ]);

        if ($request->is('api/*')) {
            return $next($request);
        }

        $ipAddress = $request->ip();

        $today = Carbon::today();

        $existingVisitor = DB::table('visitors')
            ->where('ip_address', $ipAddress)   
            ->whereDate('visited_at', $today)
            ->first();

        if (!$existingVisitor) {
            DB::table('visitors')->insert([
                'ip_address' => $ipAddress,
                'user_agent' => $request->header('User-Agent'),
                'user_id' => Auth::check() ? Auth::id() : null,
                'visited_at' => now(),
            ]);
        }
        return $next($request);
    }
}
