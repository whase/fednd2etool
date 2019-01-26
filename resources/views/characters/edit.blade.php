@extends('layouts.app')

@section('content')
    @if(Auth::user()->id == $character->user_id)
        <h2>Edit Character</h2>
        {!! Form::open(['action' => ['CharactersController@update', $character->id], 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('name', 'Name')}}
                {{Form::text('name', $character->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
            </div>
            <div class="form-group">
                {{Form::label('level', 'Level')}}
                {{Form::text('level', $character->level, ['class' => 'form-control', 'placeholder' => '1'])}}
            </div>
            <div class="form-group">
                {{Form::label('health', 'HP')}}
                {{Form::text('health', $character->health, ['class' => 'form-control', 'placeholder' => '16'])}}
            </div>
            <div class="form-group">
                {{Form::label('strength', 'STR')}}
                {{Form::text('strength', $character->strength, ['class' => 'form-control', 'placeholder' => '2'])}}
            </div>
            <div class="form-group">
                {{Form::label('magic', 'MAG')}}
                {{Form::text('magic', $character->magic, ['class' => 'form-control', 'placeholder' => '2'])}}
            </div>
            <div class="form-group">
                {{Form::label('skill', 'SKL')}}
                {{Form::text('skill', $character->skill, ['class' => 'form-control', 'placeholder' => '3'])}}
            </div>
            <div class="form-group">
                {{Form::label('speed', 'SPD')}}
                {{Form::text('speed', $character->speed, ['class' => 'form-control', 'placeholder' => '3'])}}
            </div>
            <div class="form-group">
                {{Form::label('luck', 'LCK')}}
                {{Form::text('luck', $character->luck, ['class' => 'form-control', 'placeholder' => '5'])}}
            </div>
            <div class="form-group">
                {{Form::label('defense', 'DEF')}}
                {{Form::text('defense', $character->defense, ['class' => 'form-control', 'placeholder' => '2'])}}
            </div>
            <div class="form-group">
                {{Form::label('resistance', 'RES')}}
                {{Form::text('resistance', $character->resistance, ['class' => 'form-control', 'placeholder' => '2'])}}
            </div>
            <div class="form-group">
                {{Form::label('shared', 'shared')}}
                {{Form::checkbox('shared', $character->shared, $character->shared, ['data-toggle'=> 'toggle'])}}
            </div>
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}

        {!! Form::close() !!}
    @else
        <p>You are not allowed to edit this character.</p>
    @endif
@endsection