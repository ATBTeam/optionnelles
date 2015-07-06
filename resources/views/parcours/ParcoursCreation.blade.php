@extends('template.templateAdmin')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">AJOUT DE PARCOURS
                {!! Form::open(['url' => 'admin/parcours/add']) !!}
            </div>
            <div class="panel-body">
                <div class="form-group {!! $errors->has('intitule') ? 'has-error' : '' !!}">
                    Nom :
                    {!! Form::text('intitule', null, ['class' => 'form-control', 'placeholder' => 'nom du parcours']) !!}
                    {!! $errors->first('intitule', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
                    Description :
                    {!! Form::textarea ('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
                    {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('annee') ? 'has-error' : '' !!}">
                    Année d'étude:
                    {!! Form::text('annee', null, ['class' => 'form-control', 'placeholder' => "année d'études (ex : Master 1 = 4)"]) !!}
                    {!! $errors->first('annee', '<small class="help-block">:message</small>') !!}
                </div>
            </div>
            <div class="panel-heading">Spécialité</div>
            <div class="panel-body">
                <div>
                    <select name="specialite">
                        @if (isset($specialites))
                            @foreach ($specialites as $parc)
                                <option value="{{ $parc->id }}">{{ $parc->intitule }}</option>
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('$specialites')) <p>{{ $errors->first('$specialites') }}</p> @endif
                </div>
            </div>
            <div class="panel-heading">Semestre 1</div>
            <div class="panel-body">
                <div class="form-group {!! $errors->has('nb_opt_s1') ? 'has-error' : '' !!}">
                    Nombre (max) d'UE à choisir :
                    {!! Form::text('nb_opt_s1', null, ['class' => 'form-control', 'placeholder' => "Nombre d'optionnelles(max) par etudiant S1"]) !!}
                    {!! $errors->first('nb_opt_s1', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('deb_choix_s1') ? 'has-error' : '' !!}">
                    Date d'ouverture des choix :
                    {!! Form::input('datetime-local','deb_choix_s1') !!}
                    {!! $errors->first('deb_choix_s1', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('fin_choix_s1') ? 'has-error' : '' !!}">
                    Date de fermeture des choix :
                    {!! Form::input('datetime-local','fin_choix_s1') !!}
                    {!! $errors->first('fin_choix_s1', '<small class="help-block">:message</small>') !!}
                </div>
            </div>
            <div class="panel-heading">Semestre 2</div>
            <div class="panel-body">
                <div class="form-group {!! $errors->has('nb_opt_s2') ? 'has-error' : '' !!}">
                    Nombre (max) d'UE à choisir :
                    {!! Form::text('nb_opt_s2', null, ['class' => 'form-control', 'placeholder' => "Nombre d'optionnelles(max) par etudiant S1"]) !!}
                    {!! $errors->first('nb_opt_s2', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('deb_choix_s2') ? 'has-error' : '' !!}">
                    Date d'ouverture des choix :
                    {!! Form::input('datetime-local','deb_choix_s2') !!}
                    {!! $errors->first('deb_choix_s2', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('fin_choix_s2') ? 'has-error' : '' !!}">
                    Date de fermeture des choix :
                    {!! Form::input('datetime-local','fin_choix_s2') !!}
                    {!! $errors->first('fin_choix_s2', '<small class="help-block">:message</small>') !!}
                </div>
                {!! Form::submit('Envoyer !', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop