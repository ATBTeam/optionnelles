@extends('template')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">Liste des Spécialités</div>
            <div class="panel-body">
                {!! Form::open(['url' => 'specialite/list/update']) !!}
                <div>
                    {!! Form::select('id', $table, Input::old('id'), array('size' => $table->count(), null)) !!}
                </div>
                {!! Form::submit('Modifier', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop