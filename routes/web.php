<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

Route::middleware([CheckIsNotLogged::class])->group(function(){
    Route::get('login'        , [ AuthController::class, 'login'      ]);
    Route::post('loginSubmit' , [ AuthController::class, 'loginSubmit']);
});

Route::middleware([CheckIsLogged::class])->group(function(){

    Route::controller(MainController::class)->group(function(){

        Route::get('/'                      , 'index'            )->name('home');
        Route::get('/newNote'               , 'newNote'          )->name('new');
        Route::post('/newNoteSubmit'        , 'newNoteSubmit'    )->name('newNoteSubmit');
    
        Route::get('/editNote/{id}'         , 'editNote'         )->name('edit');
        Route::post('/editNoteSubmit'       , 'editNoteSubmit'   )->name('editNoteSubmit');
        
        Route::get('/deleteNote/{id}'       , 'deleteNote'       )->name('delete');
        Route::get('/deleteNoteConfirm/{id}', 'deleteNoteConfirm')->name('deleteNoteConfirm');
    });

    Route::get('/logout', [ AuthController::class, 'logout' ])->name('logout');
});

Route::fallback(function(){
    return "Página não encontrada!";
});