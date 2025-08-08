<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // <<< BARIS INI WAJIB ADA!

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // --- DEBUGGING START ---
        // Logika 1: Cek apakah middleware ini dipanggil sama sekali.
        Log::info('AuthMiddleware: START - Request URL: ' . $request->fullUrl());
        // --- DEBUGGING END ---

        if (!Auth::check()) {
            // --- DEBUGGING START ---
            // Logika 2: Cek apakah user dianggap belum login oleh Auth::check()
            Log::warning('AuthMiddleware: User NOT logged in for URL: ' . $request->fullUrl());

            // Tambahkan ini untuk melihat nilai sesi
            // dd($request->session()->all(), Auth::user());
            // --- DEBUGGING END ---

            // Redirect ke halaman login.
            // Pastikan rute 'login' mengarah ke form loginmu.
            return redirect()->route('login');

            // Jika rute ini seharusnya API dan mengembalikan JSON, gunakan ini:
            // return response()->json([
            //     'message' => 'Unauthorized. Anda harus login untuk mengakses halaman ini.'
            // ], 401);
        }

        // --- DEBUGGING START ---
        Log::info('AuthMiddleware: User IS logged in for URL: ' . $request->fullUrl());
        // --- DEBUGGING END ---

        return $next($request);
    }
}