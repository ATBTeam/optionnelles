@extends('template')

@section('contenu')
    <h1>Créer une UE</h1>

    <hr/>
    {!! Form::open(['url' => 'ue']) !!}
        @include('ues._form', ['texteBtn' => 'Créer UE'])
    {!! Form::close() !!}
@stop