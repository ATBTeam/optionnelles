@extends('template')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">Liste des Spécialités</div>
            <div class="panel-body">
                {!! Form::open(['url' => 'specialite/list/update']) !!}
                <div>
                    <select name="specialite" size={{$specialites->count()}}>
                        @if (isset($specialites))
                            @foreach ($specialites as $parc)
                                    <option value="{{ $parc->id }}">{{ $parc->intitule }}</option>
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('$specialites')) <p>{{ $errors->first('$specialites') }}</p> @endif
                </div>
                {!! Form::submit('Modifier', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop