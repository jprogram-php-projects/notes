<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index()
    {
        $id = session('user.id');
        // $user = User::find($id)->toArray();
        $notes = User::find($id)->notes()->get()->toArray();

        // echo '<pre>';
        // print_r($user);
        // print_r($notes);
        
        return view('home', ['notes' => $notes]);
    }

    public function newNote()
    {
        echo "I'm creating a new note!";
    }

    public function editNote($id)
    {
        $id = Operations::decryptId($id);
        echo "I'm editing note with id = {$id}";
    }

    public function deleteNote($id)
    {
        $id = Operations::decryptId($id);
        echo "I'm deleting note with id = {$id}";
    }
}
