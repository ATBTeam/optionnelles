@extends('template.templateAdmin')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">PAGE DE MISE A JOUR D'UN GROUPE
                {!! Form::open(['url' => 'admin/groupe/update/'.$groupe->id]) !!}
            </div>


            @if(isset($parcours))
                <div class="panel-heading">Année suivie</div>
                <div class="panel-body">
                    <div class="form-group {!! $errors->has('parcours') ? 'has-error' : '' !!}">
                        <select name="parcours">
                            <option value="0">Choisir un parcours</option>
                            @if (isset($parcours))
                                @if(isset($groupe->parcours->id))
                                    @foreach ($parcours as $parc)
                                        @if($groupe->parcours->id == $parc->id)
                                            <option selected value="{{ $parc->id }}">{{ $parc->intitule }}</option>
                                        @else
                                            <option value="{{ $parc->id }}">{{ $parc->intitule }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($parcours as $parc)
                                        <option value="{{ $parc->id }}">{{ $parc->intitule }}</option>
                                    @endforeach
                                @endif
                            @endif
                        </select>
                        @if ($errors->has('parcours')) <small class="help-block">{{ $errors->first('parcours') }}</small> @endif
                    </div>
                </div>
            @endif



            @if(isset($groupe))
                <div class="panel-heading">Informations du groupe</div>
                <div class="panel-body">
                    <div class="form-group {!! $errors->has('intitule') ? 'has-error' : '' !!}">
                        Intitulé :
                        {!! Form::text('intitule', $groupe->intitule, ['class' => 'form-control']) !!}
                        {!! $errors->first('intitule', '<small class="help-block">:message</small>') !!}
                        @if (isset($erreurs))
                            @if (count($erreurs) > 0)
                                @foreach ($erreurs as $erreur)
                                    <small style="color:#a94442;" class="help-block">{{ $erreur }}</small>
                                @endforeach
                            @endif
                        @endif
                    </div>
                    <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
                        Description :
                        {!! Form::textarea('description', $groupe->description, ['class' => 'form-control']) !!}
                        {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
                    </div>

                    {!! Form::submit('Mettre à jour !', ['class' => 'btn btn-info pull-right']) !!}
                    {!! Form::close() !!}
                </div>
            @endif

        </div>
    </div>
@stop
