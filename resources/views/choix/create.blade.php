@extends('template')

@section('contenu')
    <h1>Liste des Choix disponibles pour les {!! $parcours->intitule !!}</h1>

    {!! Form::open(['url' => 'choix']) !!}
    <?php $i = 0; ?>
    <div class="form-group {!! $errors->has('choix') ? 'has-error' : '' !!}">
        @foreach($ues as $ue)
            <article>
                {{-- TODO : Auth::user()->id --}}
                {{-- @if(App\Choix::where('ue_id', Auth::user()->id)->where('user_id', 1)->count() == 1) --}}
                @if(App\Choix::where('ue_id', $ue->id)->where('user_id', 1)->count() == 1)
                    {!! Form::checkbox('choix[' . $i++ .']', $ue->id, true) !!}
                @else
                    {!! Form::checkbox('choix[' . $i++ .']', $ue->id) !!}
                @endif
                <a href="{{ url('/ue', $ue->id) }}">{{ $ue->intitule}}</a>
                (inscrits : {!! App\Choix::where('ue_id', $ue->id)->count() !!} / {!! App\Parcours_ue::where('ue_id',
                $ue->id)->first()->nbmax !!})
            </article>
        @endforeach
        {!! Form::submit('Valider', ['class' => 'btn btn-primary form-control']) !!}
        {!! $errors->first('choix', '
        <small class="help-block">:message</small>
        ') !!}
    </div>
    {!! Form::close() !!}
@stop