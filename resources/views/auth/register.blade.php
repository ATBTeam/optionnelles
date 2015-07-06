@extends('template.templateAdmin')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">PAGE D'INSCRIPTION
                {!! Form::open(['url' => 'compte/register']) !!}
            </div>

            @if(isset($parcours))
                <div class="panel-heading">Année suivie</div>
                <div class="panel-body">
                    <div class="form-group {!! $errors->has('parcours') ? 'has-error' : '' !!}">
                        <select name="parcours">
                            <option value="0">Choisir un parcours</option>
                            @if (isset($parcours))
                                @foreach ($parcours as $parc)
                                    @if(old('parcours') == $parc->id)
                                        <option selected value="{{ $parc->id }}">{{ $parc->intitule }}</option>
                                    @else
                                        <option value="{{ $parc->id }}">{{ $parc->intitule }}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('parcours')) <small class="help-block">{{ $errors->first('parcours') }}</small> @endif
                    </div>
                </div>
            @endif


            <div class="panel-heading">Vos informations</div>
            <div class="panel-body">
                <div class="form-group {!! $errors->has('intitule') ? 'has-error' : '' !!}">
                    Intitulé :
                    {!! Form::text('intitule', null, ['class' => 'form-control', 'placeholder' => 'intitulé du groupe']) !!}
                    {!! $errors->first('intitule', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
                    Description :
                    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'description du groupe']) !!}
                    {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
                </div>

                {!! Form::submit('Enregistrer !', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
