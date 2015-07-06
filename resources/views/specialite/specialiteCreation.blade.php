@extends('template.templateAdmin')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">Créer Spécialité</div>
            <div class="panel-body">
                {!! Form::open(['url' => 'admin/specialite/add']) !!}
                <div class="form-group {!! $errors->has('nom') ? 'has-error' : '' !!}">
                    {!! Form::text('nom', null, ['class' => 'form-control', 'placeholder' => 'nom de la spécialité']) !!}
                    {!! $errors->first('nom', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('texte') ? 'has-error' : '' !!}">
                    {!! Form::textarea ('texte', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
                    {!! $errors->first('texte', '<small class="help-block">:message</small>') !!}
                </div>
                {!! Form::submit('Envoyer !', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop