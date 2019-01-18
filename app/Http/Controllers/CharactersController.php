<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CharactersController extends Controller
{
    //
    public function index(){
        return 'Index';
    }
    public function showCharacters(){
        return view('characters.characters');
    }
}
