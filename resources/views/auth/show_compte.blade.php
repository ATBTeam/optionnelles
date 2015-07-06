@extends('template.templateAdmin')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">PAGE DE CONSULTATION VOTRE COMPTE
                {!! Form::open(['url' => 'compte']) !!}
            </div>

            @if(isset($user))
            <div class="panel-heading">Vos informations</div>
            <div class="panel-body">
                <div class="form-group">
                    Nom :
                    {!! Form::text('nom', $user->nom, ['class' => 'form-control', 'readonly']) !!}
                </div>
                <div class="form-group">
                    Prénom :
                    {!! Form::text('prenom', $user->prenom, ['class' => 'form-control', 'readonly']) !!}
                </div>
                <div class="form-group">
                    E-mail :
                    {!! Form::email('mail', $user->mail, ['class' => 'form-control', 'readonly']) !!}
                </div>
                <div class="form-group">
                    Login :
                    {!! Form::text('login', $user->login, ['class' => 'form-control', 'readonly']) !!}
                </div>
                <div class="form-group">
                    Mot de passe :
                    {!! Form::text('mdp', $user->mdp, ['class' => 'form-control', 'readonly']) !!}
                </div>
            </div>
            @endif

            @if(isset($user->parcours->id))
            <div class="panel-heading">Votre parcours</div>
            <div class="panel-body">
                <div class="form-group">
                    Parcours :
                    {!! Form::text('parcours', $user->parcours->intitule, ['class' => 'form-control', 'readonly']) !!}
                </div>
            </div>
            @endif

            @if(isset($user->groupe->id))
            <div class="panel-heading">Votre groupe</div>
            <div class="panel-body">
                <div class="form-group">
                    Groupe :
                    {!! Form::text('groupe', $user->groupe->intitule, ['class' => 'form-control', 'readonly']) !!}
                </div>
            </div>
            @endif

            @if(isset($user->profil->id))
                <div class="panel-heading">Votre profil</div>
                <div class="panel-body">
                    <div class="form-group">
                        Profil :
                        {!! Form::text('profil', $user->profil->intitule, ['class' => 'form-control', 'readonly']) !!}
                    </div>
                </div>
            @endif

            <div class="panel-body">
            {!! Form::submit('Mettre à jour !', ['class' => 'btn btn-info pull-right']) !!}
            {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
