<!-- Intitulé Form Input-->
<div class="form-group {!! $errors->has('intitule') ? 'has-error' : '' !!}">
    {!! Form::label('intitule', 'Intitulé : ') !!}
    {!! Form::text('intitule', null, ['class' => 'form-control', 'placeholder' => 'Intitulé']) !!}
    {!! $errors->first('intitule', '
    <small class="help-block">:message</small>
    ') !!}
</div>
<!-- Description Form Input-->
<div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
    {!! Form::label('description', 'Description : ') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
    {!! $errors->first('description', '
    <small class="help-block">:message</small>
    ') !!}
</div>
<!-- Semestre Form Input-->
<div class="form-group {!! $errors->has('semestre') ? 'has-error' : '' !!}">
    {!! Form::label('semestre', 'Semestre : ') !!}
    {!! Form::select('semestre', array(1 => '1er semestre', 2 => '2e semestre'), '1', ['class' => 'form-control']) !!}
    {!! $errors->first('semestre', '
    <small class="help-block">:message</small>
    ') !!}
</div>
<!-- Form Button Input-->
<div class="form-group">
    {!! Form::submit($texteBtn, ['class' => 'btn btn-primary form-control']) !!}
</div>