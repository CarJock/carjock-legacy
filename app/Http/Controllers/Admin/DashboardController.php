<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{


    /**
     * Display dashboard resources
     */
    public function index() {
        $user_role = auth()->user()->role;
        if ($user_role != "admin") {
            \Auth::logout();
            return redirect()->route('login')->with('message', 'Invalid User.');
        }
        return view('admin.dashboard');
    }
}