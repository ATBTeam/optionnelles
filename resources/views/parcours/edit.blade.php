@extends('template.templateAdmin')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">MODIFICATION DU PARCOURS
                {!! Form::model($parcours, ['url' => 'parcours/update/'.$parcours->id]) !!}
            </div>
            @include('parcours._form', ['texteBtn' => 'Mettre à jour'])
            {!! Form::close() !!}
        </div>
    </div>
@stop