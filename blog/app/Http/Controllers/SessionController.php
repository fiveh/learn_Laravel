<?php

namespace App\Http\Controllers;

//use Illuminate\Support\Facades\Auth;
//use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }


    public function create()
    {
        return view('sessions.create');
    }


    public function store()
    {
        if (!auth()->attempt(request(['email', 'password']))) {
            return back()->withErrors(
                [
                    'message' => 'Please check you email and pass! And try again.'
                ]);
        }
            return redirect()->home()->with('message', 'U are logIn!');
    }


    public function destroy()
    {
        auth()->logout();

        return redirect()->home();
    }
}
