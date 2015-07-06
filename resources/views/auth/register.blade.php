@extends('template')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">PAGE D'INSCRIPTION
                {!! Form::open(['url' => 'compte/register']) !!}
            </div>

            @if(isset($parcours))
                <div class="panel-heading">Année suivie</div>
                <div class="panel-body">
                    <div class="form-group {!! $errors->has('parcours') ? 'has-error' : '' !!}">
                        <select name="parcours">
                            <option value="0">Choisir un parcours</option>
                            @if (isset($parcours))
                                @foreach ($parcours as $parc)
                                    @if(old('parcours') == $parc->id)
                                        <option selected value="{{ $parc->id }}">{{ $parc->intitule }}</option>
                                    @else
                                        <option value="{{ $parc->id }}">{{ $parc->intitule }}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('parcours')) <small class="help-block">{{ $errors->first('parcours') }}</small> @endif
                    </div>
                </div>
            @endif

            <div class="panel-heading">Vos informations</div>
            <div class="panel-body">
                <div class="form-group {!! $errors->has('nom') ? 'has-error' : '' !!}">
                    Nom :
                    {!! Form::text('nom', null, ['class' => 'form-control', 'placeholder' => 'votre nom']) !!}
                    {!! $errors->first('nom', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('prenom') ? 'has-error' : '' !!}">
                    Prénom :
                    {!! Form::text('prenom', null, ['class' => 'form-control', 'placeholder' => 'votre prénom']) !!}
                    {!! $errors->first('prenom', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('mail') ? 'has-error' : '' !!}">
                    E-mail :
                    {!! Form::email('mail', null, ['class' => 'form-control', 'placeholder' => 'votre e-mail']) !!}
                    {!! $errors->first('mail', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('login') ? 'has-error' : '' !!}">
                    Login :
                    {!! Form::text('login', null, ['class' => 'form-control', 'placeholder' => 'votre login']) !!}
                    {!! $errors->first('login', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('mdp1') ? 'has-error' : '' !!}">
                    Mot de passe :
                    {!! Form::password('mdp1', ['class' => 'form-control', 'placeholder' => 'votre mot de passe']) !!}
                    {!! $errors->first('mdp1', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('mdp2') ? 'has-error' : '' !!}">
                    Retapez votre mot de passe :
                    {!! Form::password('mdp2', ['class' => 'form-control', 'placeholder' => 'retapez votre mot de passe']) !!}
                    {!! $errors->first('mdp2', '<small class="help-block">:message</small>') !!}
                </div>
                {!! Form::submit('Envoyer !', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
