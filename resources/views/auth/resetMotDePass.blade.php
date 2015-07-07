@extends('template.templateVisit')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">PAGE DE RENOUVEL MOT DE PASSE
                {!! Form::open(['url' => 'compte/reinitialyze/{{ $id }}']) !!}
            </div>
            <div class="panel-body">
                <div class="form-group {!! $errors->has('mdp1') ? 'has-error' : '' !!}">
                    Nouvel mot de passe :
                    {!! Form::password('mdp1', ['class' => 'form-control', 'placeholder' => 'votre nouveau mot de passe']) !!}
                    {!! $errors->first('mdp1', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('mdp2') ? 'has-error' : '' !!}">
                    Retapez votre mot de passe:
                    {!! Form::password('mdp2', ['class' => 'form-control', 'placeholder' => "retapez votre mot de passe"]) !!}
                    {!! $errors->first('mdp2', '<small class="help-block">:message</small>') !!}
                </div>
                {!! Form::submit('Réinitialiser !', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop