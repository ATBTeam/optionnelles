@extends('template.templateAdmin')

@section('style')
    <style>
        body{width:100%; margin:auto;}
        td{font-size:12px;}
        th{font-size:16px;}
        .gestion_user{width:95%; margin:auto;}
    </style>

@section('contenu')
    <br>

    <div class="gestion_user">
        <h2>PAGE DE GESTION DES UTILISATEURS</h2>

        <div style="position:fixed; z-index:100000; display:none;" id="filtrage" class="col-sm-offset-3 col-sm-6">
            <div class="panel panel-info">
                <div class="panel-heading">PAGE DE CREATION D'UN NOUVEL UTILISATEUR
                    {!! Form::open(['url' => 'admin/user']) !!}
                </div>


                <div class="panel-heading">Type de profil</div>
                <div class="panel-body">
                    <div class="form-group">
                        <select onChange="checkProfil(this);" name="profil">
                            <option value="0">Choissir tout</option>
                            <?php
                                $profils = \App\Profil::all();
                            ?>
                            @if (isset($profils))
                                @foreach ($profils as $profil)
                                    <option value="{{ $profil->id }}">{{ $profil->intitule }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>


                <div id="parcours1" class="panel-heading">Année suivie</div>
                <div id="parcours2" class="panel-body">
                    <div class="form-group">
                        <select name="parcours">
                            <option value="0">Choisir tout</option>
                            <?php
                            $parcours = \App\Parcours::all();
                            ?>
                            @if (isset($parcours))
                                @foreach ($parcours as $parc)
                                        <option value="{{ $parc->id }}">{{ $parc->intitule }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>



                    <div id="groupe1" class="panel-heading">Groupe</div>
                    <div id="groupe2" class="panel-body">
                        <div class="form-group">
                            <select name="groupe">
                                <option value="0">Choisir tout</option>
                                <?php
                                $groupes = \App\Groupe::all();
                                ?>
                                @if (isset($groupes))
                                    @foreach ($groupes as $groupe)

                                            <option value="{{ $groupe->id }}">{{ $groupe->intitule }}</option>

                                    @endforeach
                                @endif
                            </select>

                        </div>
                        
                    </div>

                <div id="groupe2" class="panel-body">
                    {!! Form::submit('Filtrer !', ['class' => 'btn btn-info pull-right']) !!}
                    {!! Form::close() !!}
                    <p onclick="hideFiltrage();" class="btn btn-info pull-right" style="margin-right: 20px; padding:5px;">Annuler</p>
                </div>

            </div>
        </div>


        <a style="float:left;" href="user/add">Créer un nouveau utilisateur</a>
        <a style="float:right; cursor: pointer;" onclick="showFiltrage();">Filtrer des utilisateurs</a>
        @if(isset($users))
            <table class="bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Login</th>
                    <th>Mot de passe</th>
                    <th>Profil</th>
                    <th>Groupe</th>
                    <th>Parcours</th>
                    <th>Activé</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
                </thead>

                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->nom }}</td>
                        <td>{{ $user->prenom }}</td>
                        <td>{{ $user->mail }}</td>
                        <td>{{ $user->login }}</td>
                        <td>{{ $user->mdp }}</td>
                        @if(isset($user->profil_id))
                            <td>{{ \App\Profil::find($user->profil_id)->intitule }}</td>
                        @else
                            <td>pas précisé</td>
                        @endif

                        @if(isset($user->groupe_id))
                            <td>{{ \App\Groupe::find($user->groupe_id)->intitule }}</td>
                        @else
                            <td>pas précisé</td>
                        @endif
                        @if(isset($user->parcours_id))
                            <td>{{ \App\Parcours::find($user->parcours_id)->intitule }}</td>
                        @else
                            <td>pas précisé</td>
                        @endif

                        @if($user->actif==1)
                            <td><a href="user/active/{{ $user->id }}" >activé</a></td>
                        @else
                            <td><a href="user/active/{{ $user->id }}" >pas activé</a></td>
                        @endif
                        <td><a href="user/update/{{ $user->id }}" >modifier</a></td>
                        <td><a href="user/delete/{{ $user->id }}" >supprimer</a></td>
                    </tr>
                @endforeach
            </table>
        @endif
        <a style="float:left;" href="user/add">Créer un nouveau utilisateur</a>
        <a style="float:right; cursor: pointer;" onclick="showFiltrage();">Filtrer des utilisateurs</a>
    </div>

    <script>
        function showFiltrage(){
            document.getElementById("filtrage").style.display = "block";
        }

        function hideFiltrage(){
            document.getElementById("filtrage").style.display = "none";
        }
        document.getElementById("parcours1").style.display = "none";
        document.getElementById("parcours2").style.display = "none";
        document.getElementById("groupe1").style.display = "none";
        document.getElementById("groupe2").style.display = "none";
        function checkProfil(obj){
            document.getElementById("parcours1").style.display = "none";
            document.getElementById("parcours2").style.display = "none";
            document.getElementById("groupe1").style.display = "none";
            document.getElementById("groupe2").style.display = "none";
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
                    break;
            }
        }
    </script>
@stop
