@extends('template.templateAdmin')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">PAGE DE CREATION D'UN NOUVEAU PROFIL
                {!! Form::open(['url' => 'admin/profil/add']) !!}
            </div>


            <div class="panel-heading">Information du profil</div>
            <div class="panel-body">
                <div class="form-group {!! $errors->has('intitule') ? 'has-error' : '' !!}">
                    Intitulé :
                    {!! Form::text('intitule', null, ['class' => 'form-control', 'placeholder' => 'intitulé du profil']) !!}
                    {!! $errors->first('intitule', '<small class="help-block">:message</small>') !!}
                </div>

                {!! Form::submit('Enregistrer !', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop