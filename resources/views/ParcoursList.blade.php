@extends('template')

@section('contenu')
    <br xmlns="http://www.w3.org/1999/html">
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">LISTE DES PARCOURS</div>
            <div class="panel-body">
                {!! Form::open(['url' => 'parcours/list/update']) !!}
                <div>
                    <script type="text/javascript">
                        function JsOnSelect()
                        {
                            var objSelect = document.getElementById("parcours");
                            var objHidden = document.getElementById("id_parcours");
                            objHidden.value = objSelect.value;
                        }
                    </script>
                    @if (isset($parcours))
                    <select name="parcours" value="{{$parcours[0]->id}}" id="parcours" onchange="JsOnSelect()" size={{$parcours->count()}}>
                            @foreach ($parcours as $parc)
                                    <option value="{{ $parc->id }}">{{ $parc->intitule." ".$parc->specialite->intitule }}</option>
                            @endforeach
                    </select>
                    @endif
                    @if ($errors->has('$parcours')) <p>{{ $errors->first('$parcours') }}</p> @endif
                </div>
                {!! Form::submit('Modifier', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
                {!! Form::open(['url' => 'parcours/list/delete']) !!}
                {!! Form::submit('Supprimer', ['class' => 'btn btn-info pull-right']) !!}
                @if (isset($parcours))
                    <input type="hidden" name="id_parcours" id="id_parcours" value="{{$parcours[0]->id}}">
                @endif
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop