@extends('layouts.app')

@section('content')
    <h1>Characters</h1>
    <p>list of available characters</p>
    @if(count($characters)>0)
        <ul class="list-group">
        @foreach($characters as $character)
            <a href="/characters/{{$character->id}}"><li class="list-group-item">{{$character->name}}<small> level: {{$character->level}}</small></li></a>
        @endforeach
        </ul>
        {{$characters->links()}}

        <a href="/characters/create"><div class="btn btn-primary">Create a New Character</div></a>
    @endif
@endsection