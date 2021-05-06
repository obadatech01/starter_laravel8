<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class CustomAuthController extends Controller
{
    public function adault()
    {
        return view('customAuth.index');
    }

    public function site()
    {
        return view('site');
    }

    public function admin()
    {
        return view('admin');
    }

    public function adminLogin()
    {
        return view('auth.adminLogin');
    }

    public function checkAdminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email'));
    }
}
