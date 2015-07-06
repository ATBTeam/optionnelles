@extends('template.templateAdmin')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">AJOUT DE PARCOURS
                {!! Form::open(['url' => 'parcours/add']) !!}
            </div>
            @include('parcours._form', ['texteBtn' => 'Créer parcours'])
                {!! Form::close() !!}
        </div>
    </div>
@stop