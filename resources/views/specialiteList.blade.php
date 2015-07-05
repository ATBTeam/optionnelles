@extends('template')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">Liste des Spécialités</div>
            <div class="panel-body">
                {!! Form::open(['url' => 'specialite/list/update']) !!}
                <div>
                    <script type="text/javascript">
                        function JsOnSelect()
                        {
                            var objSelect = document.getElementById("specialite");
                            var objHidden = document.getElementById("id_specialite");
                            objHidden.value = objSelect.value;
                        }
                    </script>
                    @if (isset($specialites))
                    <select name="specialite" value="{{$specialites[0]->id}}" id="specialite" onchange="JsOnSelect()" size={{$specialites->count()}}>
                            @foreach ($specialites as $parc)
                                    <option value="{{ $parc->id }}">{{ $parc->intitule }}</option>
                            @endforeach
                    </select>
                    @endif
                    @if ($errors->has('$specialites')) <p>{{ $errors->first('$specialites') }}</p> @endif
                </div>
                {!! Form::submit('Modifier', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
                {!! Form::open(['url' => 'specialite/list/delete']) !!}
                {!! Form::submit('Supprimer', ['class' => 'btn btn-info pull-right']) !!}
                @if (isset($specialites))
                    <input type="hidden" name="id_specialite" id="id_specialite" value="{{$specialites[0]->id}}">
                @endif
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop