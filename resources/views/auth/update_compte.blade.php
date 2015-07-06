@extends('template')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">PAGE DE MISE A JOUR VOTRE COMPTE
                {!! Form::open(['url' => 'compte/update']) !!}
            </div>
            @if(isset($user))
                <div class="panel-heading">Vos informations</div>
                <div class="panel-body">
                    <div class="form-group">
                        @if (isset($erreurs))
                            @if (count($erreurs) > 0)
                                @foreach ($erreurs as $erreur)
                                    <small style="color:#a94442;" class="help-block">{{ $erreur }}</small>
                                @endforeach
                            @endif
                        @endif
                    </div>
                    <div class="form-group {!! $errors->has('nom') ? 'has-error' : '' !!}">
                        Nom :
                        {!! Form::text('nom', $user->nom, ['class' => 'form-control']) !!}
                        {!! $errors->first('nom', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('prenom') ? 'has-error' : '' !!}">
                        Prénom :
                        {!! Form::text('prenom', $user->prenom, ['class' => 'form-control']) !!}
                        {!! $errors->first('prenom', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('mail') ? 'has-error' : '' !!}">
                        E-mail :
                        {!! Form::email('mail', $user->mail, ['class' => 'form-control']) !!}
                        {!! $errors->first('mail', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('login') ? 'has-error' : '' !!}">
                        Login :
                        {!! Form::text('login', $user->login, ['class' => 'form-control']) !!}
                        {!! $errors->first('login', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('mdp1') ? 'has-error' : '' !!}">
                        Votre mot de passe :
                        {!! Form::password('mdp1', ['class' => 'form-control', 'placeholder' => 'votre mot de passe']) !!}
                        {!! $errors->first('mdp1', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('mdp2') ? 'has-error' : '' !!}">
                        Votre nouveau mot de passe :
                        {!! Form::password('mdp2', ['class' => 'form-control', 'placeholder' => 'votre nouveau mot de passe']) !!}
                        {!! $errors->first('mdp2', '<small class="help-block">:message</small>') !!}
                    </div>
                    {!! Form::submit('Mettre à jour !', ['class' => 'btn btn-info pull-right']) !!}
                    {!! Form::close() !!}
                </div>
            @endif
        </div>
    </div>
@stop