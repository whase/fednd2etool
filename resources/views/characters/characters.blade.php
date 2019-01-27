@extends('layouts.app')

@section('content')
    <h1>Characters</h1>

    @if(count($characters)>0)
        <p>list of available characters</p>
        {!! Form::open(['action' => 'CharactersController@filter', 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('sort', 'Sort By: ')}}
                @if(isset($sort))
                    {{Form::select('sort', ['level'=> 'level','name'=> 'name'], $sort)}}
                @else
                    {{Form::select('sort', ['level'=> 'level','name'=> 'name'])}}
                @endif
            </div>
            <div class="form-group">
                {{Form::label('filter', 'search name: ')}}
                @if(isset($filter))
                     {{Form::text('filter', $filter, ['class' => 'form-control'])}}
                @else
                     {{Form::text('filter', '', ['class' => 'form-control', 'placeholder' => 'search'])}}
                @endif
            </div>
            <div class="form-group">
                {{Form::label('levelFilter', 'Level: ')}}
                @if(isset($levelFilter))
                    {{ Form::select('levelFilter', array('' => 'any') + range(1,20), $levelFilter-1) }}
                @else
                    {{ Form::select('levelFilter', array('' => 'any') + range(1,20)) }}
                @endif
            </div>
            {{Form::hidden('_method', 'GET')}}
            {{Form::submit('filter', ['class'=>'btn btn-primary'])}}

        {!! Form::close() !!}
        <table class="table table-triped">
            <tr>
                <th>Name</th>
                <th>Level</th>
                @if($role == 'dm' || $role == 'admin')
                    <th>Player</th>
                    <th></th>
                @endif
            </tr>
            @foreach($characters as $character)
                <tr>
                    <td><a href="/characters/{{$character->id}}">{{$character->name}}</a></td>
                    <td>{{$character->level}}</td>
                    @if($role == 'dm' || $role == 'admin')
                        <td>{{$character->user->name}}</td>
                        <td>
                            <a href="/characters/{{$character->id}}/edit" class="btn btn-primary">edit</a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
        {{$characters->links()}}
    @else
        <p>Please create your character</p>
    @endif

        <a href="/characters/create"><div class="btn btn-primary">Create a New Character</div></a>
    
@endsection