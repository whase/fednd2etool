@extends('layouts.app')

@section('content')
    <h2>Create New Character</h2>
    {!! Form::open(['action' => 'CharactersController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('level', 'Level')}}
            {{Form::text('level', '', ['class' => 'form-control', 'placeholder' => '1'])}}
        </div>
        <div class="form-group">
            {{Form::label('health', 'HP')}}
            {{Form::text('health', '', ['class' => 'form-control', 'placeholder' => '16'])}}
        </div>
        <div class="form-group">
            {{Form::label('strength', 'STR')}}
            {{Form::text('strength', '', ['class' => 'form-control', 'placeholder' => '2'])}}
        </div>
        <div class="form-group">
            {{Form::label('magic', 'MAG')}}
            {{Form::text('magic', '', ['class' => 'form-control', 'placeholder' => '2'])}}
        </div>
        <div class="form-group">
            {{Form::label('skill', 'SKL')}}
            {{Form::text('skill', '', ['class' => 'form-control', 'placeholder' => '3'])}}
        </div>
        <div class="form-group">
            {{Form::label('speed', 'SPD')}}
            {{Form::text('speed', '', ['class' => 'form-control', 'placeholder' => '3'])}}
        </div>
        <div class="form-group">
            {{Form::label('luck', 'LCK')}}
            {{Form::text('luck', '', ['class' => 'form-control', 'placeholder' => '5'])}}
        </div>
        <div class="form-group">
            {{Form::label('defense', 'DEF')}}
            {{Form::text('defense', '', ['class' => 'form-control', 'placeholder' => '2'])}}
        </div>
        <div class="form-group">
            {{Form::label('resistance', 'RES')}}
            {{Form::text('resistance', '', ['class' => 'form-control', 'placeholder' => '2'])}}
        </div>

        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection