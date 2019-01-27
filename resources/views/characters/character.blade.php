@extends('layouts.app')

@section('content')
    @if($character && (Auth::user()->id == $character->user_id || Auth::user()->role == 'dm' || Auth::user()->role == 'admin'))
        <h2>{{$character->name}}</h2>
        <ul class="list-group">
            <li class="list-group-item">LVL: {{$character['level']}} exp:{{$character->experience}}</li>
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
        @if($role == 'dm' || $role == 'admin')
            <a href="/characters/{{$character->id}}/edit"><div class="btn btn-primary">edit</div></a>
        @else
            @if($character->experience<100)
                {!! Form::open(['action' => ['CharactersController@addExp', $character->id], 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{Form::text('exp', '30', ['class' => 'form-control'])}}
                    </div>
                    {{Form::hidden('_method', 'PUT')}}
                    {{Form::submit('Add Exp', ['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}
            @else
                {!! Form::open(['action' => ['CharactersController@levelup', $character->id], 'method' => 'POST']) !!}
                    {{Form::hidden('_method', 'PUT')}}
                    {{Form::submit('Level Up!', ['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}
            @endif
        @endif

        {!!Form::open(['action' => ['CharactersController@destroy', $character->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close() !!}
    @else
        <p>401: You're not allowed to view this content.</p>
    @endif

    
@endsection