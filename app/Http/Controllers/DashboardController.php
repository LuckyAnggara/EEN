<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardAdmin()
    {
        $user = User::where('MENU', '!=', 'ADMIN')->get();
        // return $user;
        return view('pages/dashboard/dashboard-admin', ['user'=> $user
        ]);
    }

    public function dashboardUser()
    {
        return view('pages/dashboard/dashboard-user', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            // 'layout' => 'side-menu'
        ]);
    }
}
