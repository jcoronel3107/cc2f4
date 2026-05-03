<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsuarios = User::count();
        $totalRoles = Role::count();
        $usuariosRecientes = User::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('totalUsuarios', 'totalRoles', 'usuariosRecientes'));
    }
}