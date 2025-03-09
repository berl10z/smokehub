<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(AuthRequest $r)
    {
        $data = $r->validated();
        if (Auth::attempt($data)) {
            return redirect()->route(route: 'admin.index');
        }
        return back()->withErrors('Введены неверные данные!');
    }

    public function logout()
    {
        if(!Auth::check()){
            abort(404);
        }else{
            Auth::logout();
        }
        return to_route('home');
    }

}
