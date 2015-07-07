@extends('template.templateAdmin')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">MODIFICATION DE L'UE</div>
            {!! Form::model($ue, ['method' => 'PATCH', 'action' => ['UesController@update', $ue->id]]) !!}
            @include('ues._form', ['texteBtn' => 'Mettre à jour'])
            {!! Form::close() !!}
        </div>
    </div>

@stop