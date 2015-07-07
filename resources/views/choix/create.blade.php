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
                            Vous devez choisir <strong>
                                @if($semestre == 1)
                                    <?php $date_debut = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                            $parcours->deb_choix_s1);
                                    $date_fin = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                            $parcours->fin_choix_s1); ?>
                                    {!! App\Parcours::find($parcours_id)->nb_opt_s1 !!}
                                @else
                                    <?php $date_debut = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                            $parcours->deb_choix_s2);
                                    $date_fin = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                            $parcours->fin_choix_s2); ?>
                                    {!! App\Parcours::find($parcours_id)->nb_opt_s2 !!}
                                @endif
                                UE</strong> pour ce semestre.<br/>
                            @if(Carbon\Carbon::now() > $date_fin)
                                Les choix sont clos !
                            @elseif(Carbon\Carbon::now()->between($date_debut, $date_fin))
                                Les choix sont ouverts jusqu'au {{ $date_fin->format('d/m/Y à H:i:s') }}
                            {{ \Carbon\Carbon::setLocale('fr') }}
                                ( {{$date_fin->diffForHumans() }} environ )
                                @else
                                Les choix sont ouverts du {{ $date_debut->format('d/m/Y à H:i:s') }}
                            au {{ $date_fin->format('d/m/Y à H:i:s') }}.
                            @endif
                        </div>
                        <div class="form-group {!! (\Session::get('trop_choix_s'.$semestre) || \Session::get('trop_tard_s'.$semestre))  ? 'has-error' : '' !!}">
                            @foreach($ues[$semestre-1] as $ue)
                                <article>
                                    @if (Carbon\Carbon::now()->between($date_debut, $date_fin))
                                        {{-- Nous sommes dans la période d'ouverture des choix --}}
                                        @if(App\Parcours_ue::parcoursUe($parcours_id, $ue->id)->first()->nbmax
                                    <=
                                    App\Choix::parUe($ue->id)->parParcours($parcours_id)->count())
                                            {{-- L'UE est déjà saturée => on offre la possibilité de décocher si c'était coché, et on disable sinon --}}
                                            @if(App\Choix::parUe($ue->id)->parUser($user->id)->count() == 1)
                                                {!! Form::checkbox('choix_s'.$semestre.'[' . $i++ .']', $ue->id, true)
                                                !!}
                                            @else
                                                {!! Form::checkbox('choix_s'.$semestre.'[' . $i++ .']', $ue->id, false,
                                                ['disabled']) !!}
                                            @endif
                                            {{-- L'UE n'est pas saturée => on coche les cases correspondant aux choix précédemment renseignés --}}
                                        @else
                                            @if(App\Choix::parUe($ue->id)->parUser($user->id)->count() == 1)
                                                {!! Form::checkbox('choix_s'.$semestre.'[' . $i++ .']', $ue->id, true)
                                                !!}
                                            @else
                                                {!! Form::checkbox('choix_s'.$semestre.'[' . $i++ .']', $ue->id) !!}
                                            @endif
                                        @endif
                                    @else
                                        {{-- Nous sommes en dehors de la période d'ouverture des choix => simple affichage des choix déjà effectués mais tout est diable--}}
                                        @if(App\Choix::parUe($ue->id)->parUser($user->id)->count() == 1)
                                            {!! Form::checkbox('choix_s'.$semestre.'[' . $i++ .']', $ue->id, true,
                                            ['disabled'])
                                            !!}
                                        @else
                                            {!! Form::checkbox('choix_s'.$semestre.'[' . $i++ .']', $ue->id, false,
                                            ['disabled']) !!}
                                        @endif
                                    @endif

                                    <a href="{{ url('/ue', $ue->id) }}">{{ $ue->intitule}}</a>

                                    (inscrits : {!! App\Choix::parUe($ue->id)->parParcours($user->parcours_id)->count()
                                    !!}
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
                                <small class="help-block">{!! \Session::get('trop_tard_s'.$semestre) !!}</small>
                            {!! Form::submit('Valider', ['class' => 'btn btn-info form-control']) !!}
                        </div>
                    </div>
                </div>
            @endfor

            {!! Form::close() !!}
        </div>
    </div>
@stop