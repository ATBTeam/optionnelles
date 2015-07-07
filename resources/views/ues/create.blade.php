@extends('template.templateAdmin')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">AJOUT D'UE</div>
            {!! Form::open(['url' => 'admin/ue']) !!}
            @include('ues._form', ['texteBtn' => 'Créer UE'])
            {!! Form::close() !!}
        </div>
    </div>
@stop