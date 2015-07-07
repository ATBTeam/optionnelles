@extends('template.templateEtud')

@section('contenu')
<h1>Bienvenue sur la gestion des optionnelles !</h1>
<div class="col-sm-5 col-md-3">
    <div class="thumbnail">
        <a href="{{url('doc/doc1.pdf')}}" TARGET="_blank">
            <img src="{{url('img/adobe-pdf-logo.jpg')}}" width="100">
        </a>
        <div class="caption">
            <h3>doc1</h3>
            <p>Commentaire Doc 1</p>
            <p>
                <a href="{{url('doc/doc1.pdf')}}" class="btn btn-primary" TARGET="_blank" role="button">Ouvrir</a>
            </p>
        </div>
    </div>
</div>
<div class="col-sm-5 col-md-3">
    <div class="thumbnail">
        <a href="{{url('doc/doc2.pdf')}}" TARGET="_blank">
            <img src="{{url('img/adobe-pdf-logo.jpg')}}" width="100">
        </a>
        <div class="caption">
            <h3>doc2</h3>
            <p>Commentaire Doc 1</p>
            <p>
                <a href="{{url('doc/doc2.pdf')}}" class="btn btn-primary" TARGET="_blank" role="button">Ouvrir</a>
            </p>
        </div>
    </div>
</div>
<div class="col-sm-5 col-md-3">
    <div class="thumbnail">
        <a href="{{url('doc/doc3.pdf')}}" TARGET="_blank">
            <img src="{{url('img/adobe-pdf-logo.jpg')}}" width="100">
        </a>
        <div class="caption">
            <h3>doc3</h3>
            <p>Commentaire Doc 1</p>
            <p>
                <a href="{{url('doc/doc3.pdf')}}" class="btn btn-primary" TARGET="_blank" role="button">Ouvrir</a>
            </p>
        </div>
    </div>
</div>
<div class="col-sm-5 col-md-3">
    <div class="thumbnail">
        <a href="{{url('doc/doc4.pdf')}}" TARGET="_blank">
            <img src="{{url('img/adobe-pdf-logo.jpg')}}" width="100">
        </a>
        <div class="caption">
            <h3>doc4</h3>
            <p>Commentaire Doc 1</p>
            <p>
                <a href="{{url('doc/doc4.pdf')}}" class="btn btn-primary" TARGET="_blank" role="button">Ouvrir</a>
            </p>
        </div>
    </div>
</div>
<div class="col-sm-5 col-md-3">
    <div class="thumbnail">
        <a href="{{url('doc/doc5.pdf')}}" TARGET="_blank">
            <img src="{{url('img/adobe-pdf-logo.jpg')}}" width="100">
        </a>
        <div class="caption">
            <h3>doc5</h3>
            <p>Commentaire Doc 1</p>
            <p>
                <a href="{{url('doc/doc5.pdf')}}" class="btn btn-primary" TARGET="_blank" role="button">Ouvrir</a>
            </p>
        </div>
    </div>
</div>
<div class="col-sm-5 col-md-3">
    <div class="thumbnail">
        <a href="{{url('doc/doc6.csv')}}" TARGET="_blank">
            <img src="{{url('img/csv.png')}}" width="100">
        </a>
        <div class="caption">
            <h3>doc6</h3>
            <p>Commentaire Doc 6</p>
            <p>
                <a href="{{url('doc/doc6.csv')}}" class="btn btn-primary" TARGET="_blank" role="button">Ouvrir</a>
            </p>
        </div>
    </div>
</div>
</div>
@stop