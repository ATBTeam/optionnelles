<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{!! url('/') !!}">ADMIN</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="{!! url('admin/groupe') !!}">Formation</a></li>
                <li><a href="{!! url('admin/parcours') !!}">Parcours</a></li>
                <li><a href="{!! url('admin/specialite') !!}">Spécialités</a></li>
                <li><a href="{!! url('admin/ue') !!}">UE</a></li>
                <li><a href="{!! url('admin/user') !!}">Utilisateurs</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <li>logged as : </li>
                <li><a href="{!! url('logout') !!}">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

