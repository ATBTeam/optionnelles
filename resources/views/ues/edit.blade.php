@extends('template')

@section('contenu')
    <h1>Modifier : {!! $ue->intitule !!}</h1>

    <hr/>
    {!! Form::model($ue, ['method' => 'PATCH', 'action' => ['UesController@update', $ue->id]]) !!}
    @include('ues._form', ['texteBtn' => 'Mettre à jour'])
    {!! Form::close() !!}
@stop