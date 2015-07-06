@extends('template')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">COMFIRMATION SUPRESSION</div>
            <div class="panel-body">
                Supprimer {!! $specialite->intitule !!} ?
                {!! Form::open(['url' => 'specialite/deleteCancel']) !!}
                {!! Form::submit('NON', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}

                {!! Form::open(['url' => 'specialite/deleteConfirm/'.$specialite->id]) !!}
                {!! Form::submit('OUI', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop