<?php
namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('AdminSide.Login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard'); // Ensure correct redirect after login
        } else {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.dashboard');
    }
}
