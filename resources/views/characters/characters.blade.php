@extends('layouts.app')

@section('content')
    <h1>Characters</h1>

    @if(count($characters)>0)
        <p>list of available characters</p>
        <table class="table table-triped">
            <tr>
                <th>Name</th>
                <th>Player</th>
                <th></th>
            </tr>
            @foreach($characters as $character)
                <tr>
                    <td><a href="/characters/{{$character->id}}">{{$character->name}}</a></td>
                    <td>{{$character->user->name}}</td>
                    <td>
                        <a href="/characters/{{$character->id}}/edit" class="btn btn-primary">edit</a>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>Please create your character</p>
    @endif

        <a href="/characters/create"><div class="btn btn-primary">Create a New Character</div></a>
    
@endsection