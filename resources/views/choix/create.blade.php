@extends('template.templateEtud')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">CHOIX D'UE
                {!! Form::open(['url' => 'choix']) !!}
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div>
                        Vous trouverez la liste des UE auxquelles vous pourrez vous inscrire en tant qu'inscrit en {!!
                        $parcours->intitule !!}.
                        <br/>Tant que la période d'inscription est ouverture, vous pouvez modifier vos choix.
                        <br/>Notez que c'est le régime du <strong>premier arrivé, premier servi</strong>.
                    </div>
                </div>
            </div>
            <?php
            // TODO Auth::user()->id
            $user = App\User::find(1)->first();
            $parcours_id = $user->parcours_id;
                ?>
            @for($semestre = 1; $semestre <= 2; ++$semestre)
                <div class="panel-heading">Semestre {!! $semestre !!}</div>
                <div class="panel-body">
                    <div>
                        <?php $i = 0;?>
                        <div>
                            @if($semestre == 1)
                                Vous devez choisir <strong>{!! App\Parcours::find($parcours_id)->nb_opt_s1 !!} UE</strong> pour ce semestre.
                            @else
                                Vous devez choisir <strong>{!! App\Parcours::find($parcours_id)->nb_opt_s2 !!} UE</strong> pour ce semestre.
                            @endif
                        </div>
                        <div class="form-group {!! \Session::get('trop_choix_s'.$semestre)  ? 'has-error' : '' !!}">
                            @foreach($ues[$semestre-1] as $ue)
                                <article>
                                    @if(App\Parcours_ue::parcoursUe($parcours_id, $ue->id)->first()->nbmax
                                <=
                                App\Choix::parUe($ue->id)->parParcours($parcours_id)->count())
                                        @if(App\Choix::parUe($ue->id)->parUser($user->id)->count() == 1)
                                            {!! Form::checkbox('choix_s'.$semestre.'[' . $i++ .']', $ue->id, true) !!}
                                        @else
                                            {!! Form::checkbox('choix_s'.$semestre.'[' . $i++ .']', $ue->id, false, ['disabled']) !!}
                                        @endif
                                    @else
                                        @if(App\Choix::parUe($ue->id)->parUser($user->id)->count() == 1)
                                            {!! Form::checkbox('choix_s'.$semestre.'[' . $i++ .']', $ue->id, true) !!}
                                        @else
                                            {!! Form::checkbox('choix_s'.$semestre.'[' . $i++ .']', $ue->id) !!}
                                        @endif
                                    @endif
                                    <a href="{{ url('/ue', $ue->id) }}">{{ $ue->intitule}}</a>

                                    (inscrits : {!! App\Choix::parUe($ue->id)->parParcours($user->parcours_id)->count() !!}
                                    /
                                    {!! App\Parcours_ue::where('ue_id', $ue->id)->where('parcours_id',
                                    $user->parcours_id)->first()->nbmax
                                    !!})
                                    {{-- {!! App\Parcours_ue::parcoursUe($ue->id, $user->parcours_id)->first()->nbmax !!} --}}
                                </article>
                                @if (\Session::has('sature' . $ue->id))
                                    <small class="help-block">{!! \Session::get('sature' . $ue->id) !!}</small>
                                @endif
                            @endforeach
                            <small class="help-block">{!! \Session::get('trop_choix_s'.$semestre) !!}</small>
                            {!! Form::submit('Valider', ['class' => 'btn btn-info form-control']) !!}
                        </div>
                    </div>
                </div>
            @endfor

            {!! Form::close() !!}
        </div>
    </div>
@stop