@extends('template.template')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">Changement de mote de passe</div>
            <div class="panel-body">
                Vérifiez votre email pour réinitialiser votre compte
            </div>

            <div class="panel-heading"> <a href="{{url('/')}}"><h1>Retour à l'accueil</h1></a></div>
        </div>
    </div>
@stop