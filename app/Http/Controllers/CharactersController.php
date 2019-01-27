<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Character;
use App\User;

class CharactersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $role = auth()->user()->role;
        
        if($role == "dm" || $role == "admin")
        {
            $characters = Character::orderBy('level', 'desc')->paginate(10);
        }
        else{
            //$characters = $user->characters;
            $characters = Character::where('user_id', "=", $user_id)->orderBy('level', 'desc')->paginate(10);
        }
        
        $data = array(
            'title' => 'Characters',
            'characters' => $characters,
            'role' => $role
        );
        return view('characters.characters')->with($data);
    }
    
    public function filter(Request $request)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $sort = $request->input('sort');
        $filter = $request->input('filter');
        $role = auth()->user()->role;
        $levelFilter = $request->levelFilter;
        
        if($levelFilter != ""){
            $levelFilter++;
        }
        
//        return " ".$levelFilter;
        
        if($role == "dm" || $role == "admin")
        {
            if($levelFilter!="")
            {
                $characters = Character::orderBy($sort, 'asc')->where('level', '=', $levelFilter)->where('name', 'LIKE', '%'.$filter.'%')->orWhere('level', 'LIKE', '%'.$filter.'%')->where('level', '=', $levelFilter)->paginate(10);
            }
            else{
                $characters = Character::orderBy($sort, 'asc')->where('name', 'LIKE', '%'.$filter.'%')->orWhere('level', 'LIKE', '%'.$filter.'%')->paginate(10);
            }
                
        }
        else{
            //$characters = $user->characters;
            if($levelFilter!="")
            {
                $characters = Character::where('user_id', "=", $user_id)->where('name', 'LIKE', '%'.$filter.'%')->where('level', '=', $levelFilter)->orderBy($sort, 'asc')->paginate(10);
            }
            else{
                $characters = Character::where('user_id', "=", $user_id)->where('name', 'LIKE', '%'.$filter.'%')->orderBy($sort, 'asc')->paginate(10);
            }
            
        }
        
        $data = array(
            'title' => 'Characters',
            'characters' => $characters,
            'role' => $role,
            'sort' => $sort,
            'filter'=>$filter,
            'levelFilter' => $levelFilter
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
        $role = auth()->user()->role;
        
        $data = array(
            'title' => 'Character',
            'character' => Character::find($id),
            'role' => $role
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
        $role = auth()->user()->role;
        
        $data = array(
            'title' => 'Edit Character',
            'character' => Character::find($id),
            'role' => $role
        );
        
        return view('characters.edit')->with($data);
    }

    public function addExp(Request $request, $id)
    {
        $this->validate($request,[
            'exp' => 'required'
        ]);
        
        $character = Character::find($id);
        
        $character->experience += $request->exp;
        $character->save();
        
        return redirect('/characters/'.$id)->with('Success', 'Experience gained');
    }
    public function levelup(Request $request, $id)
    {
        
        $character = Character::find($id);
        
        $character->experience -= 100;
        $character->level++;
        $character->save();
        
        return redirect('/characters/'.$id)->with('Success', 'leveled up');
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
        
        if($request->shared ==null)
        {
            $character->shared = 0;
        }
        else{
            $character->shared = 1;
        }
      
        $character->save();
        
        return redirect('/characters/'.$id)->with('Success', 'Character Created');
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
        if(auth()->user()->id !== $character->user_id){
            return redirect('/characters')->with('error', 'Unauthorized user trying to delete character');
        }
        $character->delete();
        return redirect('/characters')->with('Success', 'Character Deleted');
    }
}
