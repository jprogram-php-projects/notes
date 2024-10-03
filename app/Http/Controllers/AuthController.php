<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        // dd($request);
        // echo $request->input('text_username'). '<br/>'. $request->input('text_password');

        $request->validate(
            // rules
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16'
            ],
            // error messages
            [
                'text_username.required' => 'O username é obrigatório!',
                'text_username.email'    => 'Username deve ser um email válido!',
                'text_password.required' => 'A password é obrigatória!',
                'text_password.min'      => 'A password deve ter pelo menos :min caracteres',
                'text_password.max'      => 'A password deve ter no máximo :max caracteres',
            ]
        );

        // get user input
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        echo 'OK!';
    }

    public function logout()
    {
        echo 'logout';
    }
}
