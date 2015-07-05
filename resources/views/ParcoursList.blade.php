@extends('template')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">LISTE DES PARCOURS</div>
            <div class="panel-body">
                {!! Form::open(['url' => 'parcours/list/update']) !!}
                <div>
                    <select name="parcours" size={{$parcours->count()}}>
                        @if (isset($parcours))
                            @foreach ($parcours as $parc)
                                    <option value="{{ $parc->id }}">{{ $parc->intitule." ".$parc->specialite->intitule }}</option>
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('$parcours')) <p>{{ $errors->first('$parcours') }}</p> @endif
                </div>
                {!! Form::submit('Modifier', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop