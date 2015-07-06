@extends('template.templateAdmin')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">Modifier Spécialité</div>
            <div class="panel-body">
                {!! Form::open(['url' => 'specialite/update/'.$specialite->id]) !!}
                <div class="form-group {!! $errors->has('nom') ? 'has-error' : '' !!}">
                    {!! Form::text('nom', $specialite->intitule, ['class' => 'form-control', 'placeholder' => 'Nom de la Spécialité']) !!}
                    {!! $errors->first('nom', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('texte') ? 'has-error' : '' !!}">
                    {!! Form::textarea ('texte', $specialite->description, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
                    {!! $errors->first('texte', '<small class="help-block">:message</small>') !!}
                </div>
                {!! Form::submit('Envoyer !', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop