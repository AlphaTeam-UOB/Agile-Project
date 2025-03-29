<?php
namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
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
        return redirect()->route('admin.login');
    }


    public function profile()
    {
        // Fetch the current logged-in admin user
        $admin = Auth::user();
        return view('AdminSide.Profile', compact('admin'));
    }

    //handle the profile update
    public function updateProfile(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|confirmed|min:6', // password is optional, only required if changing
        ]);

        // Get the current logged-in user
        $admin = Auth::user();

        // Update the name and email
        $admin->name = $request->name;
        $admin->email = $request->email;

        // Update the password if provided
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        // Save the updated admin information
        $admin->save();

        // Redirect back with a success message
        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
    }
}
