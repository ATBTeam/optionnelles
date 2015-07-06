@extends('template.templateVisit')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">PAGE DE CONNECTION
                {!! Form::open(['url' => 'login']) !!}
            </div>
            <div class="panel-body">
                <div class="form-group {!! $errors->has('login') ? 'has-error' : '' !!}">
                    Login :
                    {!! Form::text('login', null, ['class' => 'form-control', 'placeholder' => 'votre login']) !!}
                    {!! $errors->first('login', '<small class="help-block">:message</small>') !!}
                    @if (isset($actif))
                        <small style="color:#a94442;" class="help-block">Votre compte n'est pas encore activé !</small>
                    @endif
                </div>
                <div class="form-group {!! $errors->has('mdp') ? 'has-error' : '' !!}">
                   Mot de passe:
                    {!! Form::password('mdp', ['class' => 'form-control', 'placeholder' => "votre mot de passe"]) !!}
                    {!! $errors->first('mdp', '<small class="help-block">:message</small>') !!}
                </div>
                {!! Form::submit('Se connecter !', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop