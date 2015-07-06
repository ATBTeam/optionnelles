@extends('template.templateAdmin')

@section('contenu')
<h1>Bienvenue sur la gestion des optionnelles !</h1>
<div class="row">
    <div class="col-sm-5 col-md-3">
        <div class="thumbnail">
            <a href="/optionnelles/public/doc/pdf_doc_example.pdf" TARGET="_blank">
                <img src="/optionnelles/public/img/adobe-pdf-logo.jpg" width="100">
            </a>
            <div class="caption">
                <h3>MIAGE1</h3>
                <p>Programme de la MIAGE 1 et description des UEs</p>
                <p><a href="/optionnelles/public/doc/pdf_doc_example.pdf" class="btn btn-primary" TARGET="_blank" role="button">Ouvrir</a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-sm-5 col-md-3">
        <div class="thumbnail">
            <a href="/optionnelles/public/doc/pdf_doc_example.pdf" TARGET="_blank">
                <img src="/optionnelles/public/img/adobe-pdf-logo.jpg" width="100">
            </a>
            <div class="caption">
                <h3>MIAGE2</h3>
                <p>Programme de la MIAGE 2 et description des UEs</p>
                <p><a href="/optionnelles/public/doc/pdf_doc_example.pdf" class="btn btn-primary" TARGET="_blank" role="button">Ouvrir</a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-sm-5 col-md-3">
        <div class="thumbnail">
            <img src="..." alt="...">
            <div class="caption">
                <h3>Thumbnail label</h3>
                <p>Iamque non umbratis fallaciis res agebatur, sed qua palatium est extra muros, armatis omne circumdedit. ingressusque obscuro iam die, ablatis regiis indumentis Caesarem tunica texit et paludamento communi, eum post haec nihil passurum velut mandato principis iurandi crebritate confirmans et statim inquit exsurge et inopinum carpento privato inpositum ad Histriam duxit prope oppidum Polam, ubi quondam peremptum Constantini filium accepimus Crispum.</p>
                <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
            </div>
        </div>
    </div>
    <div class="col-sm-5 col-md-3">
        <div class="thumbnail">
            <img src="..." alt="...">
            <div class="caption">
                <h3>Thumbnail label</h3>
                <p>Iamque non umbratis fallaciis res agebatur, sed qua palatium est extra muros, armatis omne circumdedit. ingressusque obscuro iam die, ablatis regiis indumentis Caesarem tunica texit et paludamento communi, eum post haec nihil passurum velut mandato principis iurandi crebritate confirmans et statim inquit exsurge et inopinum carpento privato inpositum ad Histriam duxit prope oppidum Polam, ubi quondam peremptum Constantini filium accepimus Crispum.</p>
                <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
            </div>
        </div>
    </div>
</div>
@stop