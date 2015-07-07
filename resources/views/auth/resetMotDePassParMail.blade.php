@extends('template.templateVisit')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">PAGE DE RENOUVEL MOT DE PASSE PAR MAIL
                {!! Form::open(['url' => 'compte/resetMdpParMail']) !!}
            </div>
            <div class="panel-body">
                <div class="form-group {!! $errors->has('mail') ? 'has-error' : '' !!}">
                    Votre email :
                    {!! Form::email('mail',null, ['class' => 'form-control', 'placeholder' => 'votre e-mail']) !!}
                    {!! $errors->first('mail', '<small class="help-block">:message</small>') !!}
                </div>
                {!! Form::submit('Réinitialiser !', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
