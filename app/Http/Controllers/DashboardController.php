<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Route /dashboard jadi satu pintu masuk setelah login,
     * lalu diarahkan sesuai role. Customer tetap di /dashboard,
     * admin & owner diarahkan ke area masing-masing.
     */
    public function index(Request $request): View|RedirectResponse
    {
        return match ($request->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'owner' => redirect()->route('owner.dashboard'),
            default => view('dashboard'),
        };
    }
}