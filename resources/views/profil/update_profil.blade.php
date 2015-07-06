@extends('template')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">PAGE DE MISE A JOUR D'UN PROFIL
                {!! Form::open(['url' => 'admin/profil/update/'.$profil->id]) !!}
            </div>


            @if(isset($profil))
                <div class="panel-heading">Informations du profil</div>
                <div class="panel-body">
                    <div class="form-group {!! $errors->has('intitule') ? 'has-error' : '' !!}">
                        Intitulé :
                        {!! Form::text('intitule', $profil->intitule, ['class' => 'form-control']) !!}
                        {!! $errors->first('intitule', '<small class="help-block">:message</small>') !!}
                        @if (isset($erreurs))
                            @if (count($erreurs) > 0)
                                @foreach ($erreurs as $erreur)
                                    <small style="color:#a94442;" class="help-block">{{ $erreur }}</small>
                                @endforeach
                            @endif
                        @endif
                    </div>

                    {!! Form::submit('Mettre à jour !', ['class' => 'btn btn-info pull-right']) !!}
                    {!! Form::close() !!}
                </div>
            @endif

        </div>
    </div>
@stop