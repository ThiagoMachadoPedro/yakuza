<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


          public function index()
          {
                    return view('login.index');
          }



          public function store(Request $request): RedirectResponse
          {
                    $credentials = $request->validate([
                              'email' => ['required', 'email'],
                              'password' => ['required'],
                    ]);

                    $remember = $request->has('remember');


                

                    if (Auth::attempt($credentials , $remember)) {
                              $request->session()->regenerate();



                              return redirect()->intended('post-index');
                    }

                    return back()->withErrors([
                              'email' => 'As credenciais estão incorretas!',
                    ])->onlyInput('email');
          }


          public function destroy()
          {
                    Auth::logout();
                    return redirect()->route('login-index');
          }
}
