@extends('template.templateAdmin')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">PAGE DE MISE A JOUR L'UTILISATEUR : @if(isset($user)) {{ $user->prenom }} &nbsp; {{ $user->nom }}  @endif
                {!! Form::open(['url' => 'admin/user/update/'.$user->id]) !!}
            </div>

            @if (isset($profils))
                <div class="panel-heading">Type de profil</div>
                <div class="panel-body">
                    <div class="form-group {!! $errors->has('profil') ? 'has-error' : '' !!}">
                        <select onChange="checkProfil(this);" name="profil">
                            <option value="0">Choissir un profil</option>
                            @if (isset($profils))
                                @foreach ($profils as $profil)
                                    @if($user->profil->id == $profil->id)
                                        <option selected value="{{ $profil->id }}">{{ $profil->intitule }}</option>
                                    @else
                                        <option value="{{ $profil->id }}">{{ $profil->intitule }}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('profil')) <small class="help-block">{{ $errors->first('profil') }}</small> @endif
                    </div>
                </div>
            @endif

            @if(isset($parcours))
                <div id="parcours1" class="panel-heading">Année suivie</div>
                <div id="parcours2" class="panel-body">
                    <div class="form-group {!! $errors->has('parcours') ? 'has-error' : '' !!}">
                        <select name="parcours">
                            <option value="0">Choisir un parcours</option>
                            @if (isset($parcours))
                                @if(isset($user->parcours->id))
                                    @foreach ($parcours as $parc)
                                        @if($user->parcours->id == $parc->id)
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

            @if(isset($groupes))
                <div id="groupe1" class="panel-heading">Groupe</div>
                <div id="groupe2" class="panel-body">
                    <div class="form-group {!! $errors->has('groupe') ? 'has-error' : '' !!}">
                        <select name="groupe">
                            <option value="0">Choisir un groupe</option>
                            @if (isset($groupes))
                                @if(isset($user->groupe->id))
                                    @foreach ($groupes as $groupe)
                                        @if($user->groupe->id == $groupe->id)
                                            <option selected value="{{ $groupe->id }}">{{ $groupe->intitule }}</option>
                                        @else
                                            <option value="{{ $groupe->id }}">{{ $groupe->intitule }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($groupes as $groupe)
                                        <option value="{{ $groupe->id }}">{{ $groupe->intitule }}</option>
                                    @endforeach
                                @endif
                            @endif
                        </select>
                        @if ($errors->has('groupe')) <small class="help-block">{{ $errors->first('groupe') }}</small> @endif
                    </div>
                </div>
            @endif

            @if(isset($ues))
                <div id="ue1" class="panel-heading">Ues</div>
                <div id="ue2" class="panel-body">
                    <div class="form-group {!! $errors->has('ue') ? 'has-error' : '' !!}">
                        @if(isset($user->uesEnseignees[0]))
                            @foreach($ues as $ue)
                                <span style="display:none;">{{ $check = false }}</span>
                                @foreach($user->uesEnseignees as $uE)
                                    @if($ue->id == $uE->id)
                                        <input checked type="checkbox" name="ues[]" value="{{ $ue->id }}" />{{ $ue->intitule }} &nbsp; &nbsp; &nbsp;
                                        <span style="display:none;">{{ $check = true }}</span>
                                    @endif
                                @endforeach
                                @if($check==false)
                                    <input type="checkbox" name="ues[]" value="{{ $ue->id }}" >{{ $ue->intitule }} &nbsp; &nbsp; &nbsp;
                                @endif
                                <span style="display:none;">{{ $check = false }}</span>
                            @endforeach
                        @else
                            @foreach($ues as $ue)
                                <input type="checkbox" name="ues[]" value="{{ $ue->id }}" />{{ $ue->intitule }} &nbsp; &nbsp; &nbsp;
                            @endforeach
                        @endif
                    </div>
                </div>
            @endif

            @if(isset($user))
                <div class="panel-heading">Vos informations</div>
                <div class="panel-body">
                    <div class="form-group">
                        @if (isset($erreurs))
                            @if (count($erreurs) > 0)
                                @foreach ($erreurs as $erreur)
                                    <small style="color:#a94442;" class="help-block">{{ $erreur }}</small>
                                @endforeach
                            @endif
                        @endif
                    </div>
                    <div class="form-group {!! $errors->has('nom') ? 'has-error' : '' !!}">
                        Nom :
                        {!! Form::text('nom', $user->nom, ['class' => 'form-control']) !!}
                        {!! $errors->first('nom', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('prenom') ? 'has-error' : '' !!}">
                        Prénom :
                        {!! Form::text('prenom', $user->prenom, ['class' => 'form-control']) !!}
                        {!! $errors->first('prenom', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('mail') ? 'has-error' : '' !!}">
                        E-mail :
                        {!! Form::email('mail', $user->mail, ['class' => 'form-control']) !!}
                        {!! $errors->first('mail', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('login') ? 'has-error' : '' !!}">
                        Login :
                        {!! Form::text('login', $user->login, ['class' => 'form-control']) !!}
                        {!! $errors->first('login', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('mdp1') ? 'has-error' : '' !!}">
                        Ancien mot de passe :
                        {!! Form::text('mdp1', $user->login, ['class' => 'form-control', 'readonly']) !!}
                        {!! $errors->first('mdp1', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('mdp2') ? 'has-error' : '' !!}">
                        Nouveau mot de passe :
                        {!! Form::password('mdp2', ['class' => 'form-control', 'placeholder' => 'nouveau mot de passe']) !!}
                        {!! $errors->first('mdp2', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('actif') ? 'has-error' : '' !!}">
                        Acitivé :
                        @if($user->actif == 1)
                            <input checked type="checkbox" name="actif" value="1">
                        @else
                            <input type="checkbox" name="actif" value="1">
                        @endif
                        {!! $errors->first('actif', '<small class="help-block">:message</small>') !!}
                    </div>
                    {!! Form::submit('Mettre à jour !', ['class' => 'btn btn-info pull-right']) !!}
                    {!! Form::close() !!}
                </div>
            @endif



        </div>
    </div>

    <script>
        document.getElementById("parcours1").style.display = "none";
        document.getElementById("parcours2").style.display = "none";
        document.getElementById("groupe1").style.display = "none";
        document.getElementById("groupe2").style.display = "none";
        document.getElementById("ue1").style.display = "none";
        document.getElementById("ue2").style.display = "none";
        function checkProfil(obj){
            document.getElementById("parcours1").style.display = "none";
            document.getElementById("parcours2").style.display = "none";
            document.getElementById("groupe1").style.display = "none";
            document.getElementById("groupe2").style.display = "none";
            document.getElementById("ue1").style.display = "none";
            document.getElementById("ue2").style.display = "none";
            var profil;
            @foreach(\App\Profil::all() as $profil)
            if(obj.value == "{{ $profil->id }}"){
                profil = "{!! $profil->intitule !!}";
            }
            @endforeach
            switch (profil){
                case "étudiant":
                    document.getElementById("parcours1").style.display = "block";
                    document.getElementById("parcours2").style.display = "block";
                    document.getElementById("groupe1").style.display = "block";
                    document.getElementById("groupe2").style.display = "block";
                    break;
                case "professeur":
                    document.getElementById("ue1").style.display = "block";
                    document.getElementById("ue2").style.display = "block";
                    break;
            }
        }
    </script>
@stop
