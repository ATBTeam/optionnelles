<div class="panel-body">
    <div class="form-group {!! $errors->has('intitule') ? 'has-error' : '' !!}">
        {!! Form::label('intitule', 'Intitulé : ') !!}
        {!! Form::text('intitule', null, ['class' => 'form-control', 'placeholder' => 'Intitulé du parcours']) !!}
        {!! $errors->first('intitule', '
        <small class="help-block">:message</small>
        ') !!}
    </div>
    <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
        {!! Form::label('description', 'Description : ') !!}
        {!! Form::textarea ('description', null, ['class' => 'form-control', 'placeholder' => 'Description du parcours']) !!}
        {!! $errors->first('description', '
        <small class="help-block">:message</small>
        ') !!}
    </div>
    <div class="form-group {!! $errors->has('annee') ? 'has-error' : '' !!}">
        {!! Form::label('annee', 'Année d\'étude : ') !!}
        {!! Form::text('annee', null, ['class' => 'form-control', 'placeholder' => "année d'études (ex : Master 1 =
        4)"]) !!}
        {!! $errors->first('annee', '
        <small class="help-block">:message</small>
        ') !!}
    </div>
</div>
<div class="panel-heading">Spécialité</div>
<div class="panel-body">
    <div>
        <select name="specialite">
            @if (isset($specialites))
                @foreach ($specialites as $spe)
                    <option value="{{ $spe->id }}">{{ $spe->intitule }}</option>
                @endforeach
            @endif
        </select>
        @if ($errors->has('$specialites')) <p>{{ $errors->first('$specialites') }}</p> @endif
    </div>
</div>
<div class="panel-heading">Semestre 1</div>
<div class="panel-body">
    <div class="form-group {!! $errors->has('nb_opt_s1') ? 'has-error' : '' !!}">
        {!! Form::label('nb_opt_s1', 'Nombre d\'UE à choisir : ') !!}
        {!! Form::text('nb_opt_s1', null, ['class' => 'form-control', 'placeholder' => "Nombre d'optionnelles par
        etudiant S1"]) !!}
        {!! $errors->first('nb_opt_s1', '
        <small class="help-block">:message</small>
        ') !!}
    </div>
    <div class="form-group {!! $errors->has('deb_choix_s1') ? 'has-error' : '' !!}">
        {!! Form::label('deb_choix_s1', 'Date d\'ouverture des choix : ') !!}
        {!! Form::input('datetime-local','deb_choix_s1') !!}
        {!! $errors->first('deb_choix_s1', '
        <small class="help-block">:message</small>
        ') !!}
    </div>
    <div class="form-group {!! $errors->has('fin_choix_s1') ? 'has-error' : '' !!}">
        {!! Form::label('deb_fin_s1', 'Date de fermeture des choix : ') !!}
        {!! Form::input('datetime-local','fin_choix_s1') !!}
        {!! $errors->first('fin_choix_s1', '
        <small class="help-block">:message</small>
        ') !!}
    </div>
</div>
<div class="panel-heading">Semestre 2</div>
<div class="panel-body">
    <div class="form-group {!! $errors->has('nb_opt_s2') ? 'has-error' : '' !!}">
        {!! Form::label('nb_opt_s2', 'Nombre d\'UE à choisir : ') !!}
        {!! Form::text('nb_opt_s2', null, ['class' => 'form-control', 'placeholder' => "Nombre d'optionnelles par
        etudiant S2"]) !!}
        {!! $errors->first('nb_opt_s2', '
        <small class="help-block">:message</small>
        ') !!}
    </div>
    <div class="form-group {!! $errors->has('deb_choix_s2') ? 'has-error' : '' !!}">
        {!! Form::label('deb_choix_s2', 'Date d\'ouverture des choix : ') !!}
        {!! Form::input('datetime-local','deb_choix_s2') !!}
        {!! $errors->first('deb_choix_s2', '
        <small class="help-block">:message</small>
        ') !!}
    </div>
    <div class="form-group {!! $errors->has('fin_choix_s2') ? 'has-error' : '' !!}">
        {!! Form::label('deb_choix_s2', 'Date de fermeture des choix : ') !!}
        {!! Form::input('datetime-local', 'fin_choix_s2', Carbon\Carbon::now()->toDateTimeString(), ['class' => 'form-control']) !!}
        {!! $errors->first('fin_choix_s2', '
        <small class="help-block">:message</small>
        ') !!}
    </div>
    {!! Form::submit($texteBtn, ['class' => 'btn btn-info pull-right']) !!}
</div>