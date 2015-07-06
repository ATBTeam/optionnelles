@extends('template.templateAdmin')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">COMFIRMATION SUPRESSION</div>
            <div class="panel-body">
                Supprimer {!!$parcours->intitule." ".$parcours->specialite->intitule !!} ?
                {!! Form::open(['url' => 'parcours/deleteCancel']) !!}
                {!! Form::submit('NON', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}

                {!! Form::open(['url' => 'parcours/deleteConfirm/'.$parcours->id]) !!}
                {!! Form::submit('OUI', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop