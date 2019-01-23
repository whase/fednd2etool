@extends('layouts.app')

@section('content')
    @if($character)
        <h2>{{$character->name}}</h2>
        <ul class="list-group">
            
            <li class="list-group-item">HP: {{$character['current health']}}/{{$character->health}}</li>
            <li class="list-group-item">STR: {{$character->strength}}</li>
            <li class="list-group-item">MAG: {{$character->magic}}</li>
            <li class="list-group-item">SKL: {{$character->skill}}</li>
            <li class="list-group-item">SPD: {{$character->speed}}</li>
            <li class="list-group-item">LCK: {{$character->luck}}</li>
            <li class="list-group-item">DEF: {{$character->defense}}</li>
            <li class="list-group-item">RES: {{$character->resistance}}</li>
            <li class="list-group-item">MOV: {{$character->movement}}</li>
        
        </ul>

        <a href="/characters/{{$character->id}}/edit"><div class="btn btn-primary">edit</div></a>
    @endif
@endsection