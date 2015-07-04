@extends('template')

@section('contenu')
    {!! Form::open(['url' => 'specialite/modification']) !!}
    {!! Form::label('nom', 'Entrez le nom : ') !!}
    {!! Form::text('nom') !!}
    {!! Form::submit('Envoyer !') !!}
    {!! Form::close() !!}
@stop