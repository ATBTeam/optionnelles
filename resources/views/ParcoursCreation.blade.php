@extends('template')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">Créer Spécialité</div>
            <div class="panel-body">
                {!! Form::open(['url' => 'specialite/add']) !!}
                <div class="form-group {!! $errors->has('intitule') ? 'has-error' : '' !!}">
                    {!! Form::text('intitule', null, ['class' => 'form-control', 'placeholder' => 'nom du parcours']) !!}
                    {!! $errors->first('intitule', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
                    {!! Form::textarea ('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
                    {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('annee') ? 'has-error' : '' !!}">
                    {!! Form::text('annee', null, ['class' => 'form-control', 'placeholder' => 'année']) !!}
                    {!! $errors->first('annee', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('nb_opt_s1') ? 'has-error' : '' !!}">
                    {!! Form::text('nb_opt_s1', null, ['class' => 'form-control', 'placeholder' => 'Nb Max opt Etudiant S1']) !!}
                    {!! $errors->first('nb_opt_s1', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('nb_opt_s2') ? 'has-error' : '' !!}">
                    {!! Form::text('nb_opt_s2', null, ['class' => 'form-control', 'placeholder' => 'Nb Max opt Etudiant S2']) !!}
                    {!! $errors->first('nb_opt_s2', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('deb_choix_s1') ? 'has-error' : '' !!}">
                    {!! Form::text('deb_choix_s1', null, ['class' => 'form-control', 'placeholder' => 'Nb Max opt Etudiant S2']) !!}
                    {!! $errors->first('deb_choix_s1', '<small class="help-block">:message</small>') !!}
                </div>
                {!! Form::submit('Envoyer !', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop