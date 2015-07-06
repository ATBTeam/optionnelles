@extends('template')

@section('contenu')
    <h1>Liste des Choix disponibles pour les {!! $parcours->intitule !!}</h1>

    {!! Form::open(['url' => 'choix']) !!}
    <?php $i = 0;
    // TODO Auth::user()->id
    $user = App\User::find(1)->first();
    $parcours_id = $user->parcours_id;
    ?>
    <div class="form-group {!! $errors->has('choix') ? 'has-error' : '' !!}">
        @foreach($ues as $ue)
            <article>
                {{-- TODO : Auth::user()->id --}}
                {{-- @if(App\Choix::where('ue_id', Auth::user()->id)->where('user_id', 1)->count() == 1) --}}
                @if(App\Parcours_ue::parcoursUe($parcours_id, $ue->id)->first()->nbmax
            <=
            App\Choix::parUe($ue->id)->parParcours($parcours_id)->count())
                    @if(App\Choix::parUe($ue->id)->parUser($user->id)->count() == 1)
                        {!! Form::checkbox('choix[' . $i++ .']', $ue->id, true) !!}
                    @else
                        {!! Form::checkbox('choix[' . $i++ .']', $ue->id, false, ['disabled']) !!}
                    @endif
                @else
                    @if(App\Choix::parUe($ue->id)->parUser($user->id)->count() == 1)
                        {!! Form::checkbox('choix[' . $i++ .']', $ue->id, true) !!}
                    @else
                        {!! Form::checkbox('choix[' . $i++ .']', $ue->id) !!}
                    @endif
                @endif
                <a href="{{ url('/ue', $ue->id) }}">{{ $ue->intitule}}</a>

                (inscrits : {!! App\Choix::parUe($ue->id)->parParcours($user->parcours_id)->count() !!} /
                {!! App\Parcours_ue::where('ue_id', $ue->id)->where('parcours_id', $user->parcours_id)->first()->nbmax
                !!})
                {{-- {!! App\Parcours_ue::parcoursUe($ue->id, $user->parcours_id)->first()->nbmax !!} --}}
            </article>
            @if (\Session::has('sature' . $ue->id))
                <small class="help-block">{!! \Session::get('sature' . $ue->id) !!}</small>
            @endif
        @endforeach
        {!! Form::submit('Valider', ['class' => 'btn btn-primary form-control']) !!}
        {!! $errors->first('choix', '
        <small class="help-block">:message</small>
        ') !!}
    </div>
    {!! Form::close() !!}
@stop