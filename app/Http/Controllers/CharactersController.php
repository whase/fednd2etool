<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Character;
use App\User;

class CharactersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        
        $data = array(
            'title' => 'Characters',
//            'characters' => Character::orderBy('level', 'desc')->paginate(10)
            'characters' => $user->characters
        );
        return view('characters.characters')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'title' => 'Create new Character'
        );
        return view('characters.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        
        // Create Character
        $character = new Character;
        $character->name = $request->input('name');
        
        if ($request->input('level')!=null) {
            $character->level = $request->input('level');
        } else{$character->level = 1;}
        if ($request->input('health')!=null) {
            $character->health = $request->input('health');
        } else{$character->health = 16;}
        $character['current health'] = $character->health;
        if ($request->input('strength')!=null) {
            $character->strength = $request->input('strength');
        } else{$character->strength = 2;}
        if ($request->input('magic')!=null) {
            $character->magic = $request->input('magic');
        } else{$character->magic = 2;}
        if ($request->input('skill')!=null) {
            $character->skill = $request->input('skill');
        } else{$character->skill = 3;}
        if ($request->input('speed')!=null) {
            $character->speed = $request->input('speed');
        } else{$character->speed = 3;}
        if ($request->input('luck')!=null) {
            $character->luck = $request->input('luck');
        } else{$character->luck = 5;}
        if ($request->input('defense')!=null) {
            $character->defense = $request->input('defense');
        } else{$character->defense = 2;}
        if ($request->input('resistance')!=null) {
            $character->resistance = $request->input('resistance');
        } else{$character->resistance = 2;}
        
        $character->movement = 3;
        $character->shared = false;
        $character->user_id = auth()->user()->id;
        
        $character->save();
        
        return redirect('/characters')->with('Success', 'Character Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array(
            'title' => 'Character',
            'character' => Character::find($id)
        );
        
        return view('characters.character')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array(
            'title' => 'Edit Character',
            'character' => Character::find($id)
        );
        
        return view('characters.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        
        // Create Character
        $character = Character::find($id);
        $character->name = $request->input('name');
        
        if ($request->input('level')!=null) {
            $character->level = $request->input('level');
        } else{$character->level = 1;}
        if ($request->input('health')!=null) {
            $character->health = $request->input('health');
        } else{$character->health = 16;}
        $character['current health'] = $character->health;
        if ($request->input('strength')!=null) {
            $character->strength = $request->input('strength');
        } else{$character->strength = 2;}
        if ($request->input('magic')!=null) {
            $character->magic = $request->input('magic');
        } else{$character->magic = 2;}
        if ($request->input('skill')!=null) {
            $character->skill = $request->input('skill');
        } else{$character->skill = 3;}
        if ($request->input('speed')!=null) {
            $character->speed = $request->input('speed');
        } else{$character->speed = 3;}
        if ($request->input('luck')!=null) {
            $character->luck = $request->input('luck');
        } else{$character->luck = 5;}
        if ($request->input('defense')!=null) {
            $character->defense = $request->input('defense');
        } else{$character->defense = 2;}
        if ($request->input('resistance')!=null) {
            $character->resistance = $request->input('resistance');
        } else{$character->resistance = 2;}
        
        $character->movement = 3;
        $character->shared = false;
        
        $character->save();
        
        return redirect('/characters')->with('Success', 'Character Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $character = Character::find($id);
        $character->delete();
        return redirect('/characters')->with('Success', 'Character Deleted');
    }
}
