<?php

namespace App\Http\Controllers;

use App\User;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }


    public function store()
    {
//        validate form
        $this->validate(request(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:4'
            ]);

//        create and save
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

//        sign him in
        auth()->login($user);

//        redirect to home page
        return redirect()->home();
    }
}
