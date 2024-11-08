<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        $id = session('user.id');
        // $user = User::find($id)->toArray();
        $notes = User::find($id)
                    ->notes()
                    ->whereNull('deleted_at')
                    ->get()
                    ->toArray();

        // echo '<pre>';
        // print_r($user);
        // print_r($notes);
        
        return view('home', ['notes' => $notes]);
    }

    public function newNote()
    {
        return view('new_note');
    }

    public function newNoteSubmit(Request $request)
    {
        // validate request
        $request->validate(
            // rules
            [
                'text_title' => 'required|min:3|max:200',
                'text_note'  => 'required|min:3|max:3000'
            ],
            // error messages
            [
                'text_title.required' => 'O título é obrigatório!',
                'text_title.min'      => 'O título deve ter pelo menos :min caracteres',
                'text_title.max'      => 'O título deve ter no máximo :max caracteres',
                'text_note.required'  => 'A nota é obrigatória!',
                'text_note.min'       => 'A nota deve ter pelo menos :min caracteres',
                'text_note.max'       => 'A nota deve ter no máximo :max caracteres',
            ]
        );

        // get user id
        $id = session('user.id');

        // create new note
        $note = new Note();
        $note->user_id = $id;
        $note->title   = $request->text_title;
        $note->text    = $request->text_note;
        $note->save();

        // redirect to home
        return redirect()->route('home');
    }
    
    public function editNote($id): View
    {
        $id = Operations::decryptId($id);

        if($id === null){
            return redirect()->route('home');
        }
        //echo "I'm editing note with id = {$id}";

        // load note
        $note = Note::find($id);

        // show edit note view
        return view('edit_note', ['note' => $note]);       
    }

    public function editNoteSubmit(Request $request): RedirectResponse
    {
        // validate request
        $request->validate(
            // rules
            [
                'text_title' => 'required|min:3|max:200',
                'text_note'  => 'required|min:3|max:3000'
            ],
            // error messages
            [
                'text_title.required' => 'O título é obrigatório!',
                'text_title.min'      => 'O título deve ter pelo menos :min caracteres',
                'text_title.max'      => 'O título deve ter no máximo :max caracteres',
                'text_note.required'  => 'A nota é obrigatória!',
                'text_note.min'       => 'A nota deve ter pelo menos :min caracteres',
                'text_note.max'       => 'A nota deve ter no máximo :max caracteres',
            ]
        );

        // check if note_id exists
        if ($request->note_id == null) {
            return redirect()->route('home');
        }

        // decrypt note_id
        $id = Operations::decryptId($request->note_id);

        if($id === null){
            return redirect()->route('home');
        }

        // load note
        $note = Note::find($id);

        // update note
        $note->title   = $request->text_title;
        $note->text    = $request->text_note;
        $note->save();

        // redirect to home
        return redirect()->route('home');
    }

    public function deleteNote($id): View
    {
        $id = Operations::decryptId($id);

        if($id === null){
            return redirect()->route('home');
        }
        // echo "I'm deleting note with id = {$id}";

        // load note
        $note = Note::find($id);

        // show edit note view
        return view('delete_note', ['note' => $note]);   
    }

    public function deleteNoteConfirm($id)
    {
        $id = Operations::decryptId($id);

        if($id === null){
            return redirect()->route('home');
        }

        // load note
        $note = Note::find($id);

        // hard delete
        // $note->delete();

        // soft delete
        // $note->deleted_at = date('Y-m-d H:i:s');
        // $note->save();

        // soft delete (property SoftDeletes in model)
        $note->delete();

        // hard delete (property SoftDeletes in model)
        // $note->forceDelete();

        // redirect to home
        return redirect()->route('home');
    }
}
