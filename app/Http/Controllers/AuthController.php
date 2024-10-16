<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // try {
        //     DB::connection()->getPdo();
        //     echo 'Connection is OK!';
        // } catch (\PDOException $e) {
        //     echo 'Connection failed: '. $e->getMessage();
        // }

        // echo 'FIM!';

        // get all the users from the database
        // $users = User::get()->toArray();
        
        // as an object instance of the model's class
        // $userModel = new User();
        // $users = $userModel::get()->toArray();

        // check if user exists
        $user = User::where('username', $username)
                      ->where('deleted_at', NULL)
                      ->first();
  
        if(!$user){
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('loginError', 'Username ou password estão incorretos!');
        }

        // check if password is correct
        if(!password_verify($password, $user->password)){
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('loginError', 'Username ou password estão incorretos!');
        }

        // echo '<pre>';
        // print_r($user);
        echo 'LOGIN REALIZADO COM SUCESSO!';
    }

    public function logout()
    {
        echo 'logout';
    }
}
