@extends('template.templateAdmin')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">CONFIRMATION SUPRESSION</div>
            <div class="panel-body">
                Supprimer {!! $ue->intitule !!} ?
                {!! Form::open(['url' => 'admin/ue/deleteCancel']) !!}
                {!! Form::submit('NON', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}

                {!! Form::open(['url' => 'admin/ue/deleteConfirm/'.$ue->id]) !!}
                {!! Form::submit('OUI', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop