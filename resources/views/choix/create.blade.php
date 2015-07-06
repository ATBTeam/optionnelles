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
            <div class="panel-heading">Semestre 1</div>
            <div class="panel-body">
                <div>
                    <?php $i = 0;
                    // TODO Auth::user()->id
                    $user = App\User::find(1)->first();
                    $parcours_id = $user->parcours_id;
                    ?>
                    <div>
                        Vous devez choisir <strong>{!! App\Parcours::find($parcours_id)->nb_opt_s1 !!} UE</strong> pour
                        ce semestre.
                    </div>
                    <div class="form-group {!! $errors->has('choix') ? 'has-error' : '' !!}">
                        @foreach($ues_s1 as $ue)
                            <article>
                                @if(App\Parcours_ue::parcoursUe($parcours_id, $ue->id)->first()->nbmax
                            <=
                            App\Choix::parUe($ue->id)->parParcours($parcours_id)->count())
                                    @if(App\Choix::parUe($ue->id)->parUser($user->id)->count() == 1)
                                        {!! Form::checkbox('choix_s1[' . $i++ .']', $ue->id, true) !!}
                                    @else
                                        {!! Form::checkbox('choix_s1[' . $i++ .']', $ue->id, false, ['disabled']) !!}
                                    @endif
                                @else
                                    @if(App\Choix::parUe($ue->id)->parUser($user->id)->count() == 1)
                                        {!! Form::checkbox('choix_s1[' . $i++ .']', $ue->id, true) !!}
                                    @else
                                        {!! Form::checkbox('choix_s1[' . $i++ .']', $ue->id) !!}
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
                            <small class="help-block">{!! \Session::get('trop_choix_s1') !!}</small>
                        {!! Form::submit('Valider', ['class' => 'btn btn-info form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="panel-heading">Semestre 2</div>
            <div class="panel-body">
                <div>
                    <?php $i = 0;?>
                    <div>
                        Vous devez choisir <strong>{!! App\Parcours::find($parcours_id)->nb_opt_s2 !!} UE</strong> pour
                        ce semestre.
                    </div>
                    <div class="form-group {!! $errors->has('choix') ? 'has-error' : '' !!}">
                        @foreach($ues_s2 as $ue)
                            <article>
                                @if(App\Parcours_ue::parcoursUe($parcours_id, $ue->id)->first()->nbmax
                            <=
                            App\Choix::parUe($ue->id)->parParcours($parcours_id)->count())
                                    @if(App\Choix::parUe($ue->id)->parUser($user->id)->count() == 1)
                                        {!! Form::checkbox('choix_s2[' . $i++ .']', $ue->id, true) !!}
                                    @else
                                        {!! Form::checkbox('choix_s2[' . $i++ .']', $ue->id, false, ['disabled']) !!}
                                    @endif
                                @else
                                    @if(App\Choix::parUe($ue->id)->parUser($user->id)->count() == 1)
                                        {!! Form::checkbox('choix_s2[' . $i++ .']', $ue->id, true) !!}
                                    @else
                                        {!! Form::checkbox('choix_s2[' . $i++ .']', $ue->id) !!}
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
                            <small class="help-block">{!! \Session::get('trop_choix_s2') !!}</small>
                        {!! Form::submit('Valider', ['class' => 'btn btn-info form-control']) !!}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop