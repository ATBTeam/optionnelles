<div class="panel-body">
    <div class="form-group {!! $errors->has('intitule') ? 'has-error' : '' !!}">
        {!! Form::label('intitule', 'Intitulé : ') !!}
        {!! Form::text('intitule', null, ['class' => 'form-control', 'placeholder' => 'Intitulé']) !!}
        {!! $errors->first('intitule', '
        <small class="help-block">:message</small>
        ') !!}
    </div>
    <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
        {!! Form::label('description', 'Description : ') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
        {!! $errors->first('description', '
        <small class="help-block">:message</small>
        ') !!}
    </div>
    <div class="form-group {!! $errors->has('semestre') ? 'has-error' : '' !!}">
        {!! Form::label('semestre', 'Semestre : ') !!}
        {!! Form::select('semestre', array(1 => '1er semestre', 2 => '2e semestre'), '1', ['class' => 'form-control'])
        !!}
        {!! $errors->first('semestre', '
        <small class="help-block">:message</small>
        ') !!}
    </div>
</div>
<div class="panel-heading">Parcours</div>
<div class="panel-body">
    <table class="bordered">
        <thead>
        <tr>
            <th>Parcours</th>
            <th>Statut</th>
            <th>Nb Minimum d'étudiants</th>
            <th>Nb maximum d'étudiants</th>
        </tr>
        </thead>

        @foreach($parcours as $parc)
            <tr>
                <td>{{ $parc->intitule }}</td>
            @if($parcours_ues->contains('parcours_id' , $parc->id))
                <?php
                    $parc_ue = $parcours_ues->where('parcours_id', $parc->id)->first();
                ?>
                    <td>
                        <div class="form-group {!! $errors->has('statut' . $parc->id) ? 'has-error' : '' !!}">
                            {!! Form::select('statut' . $parc->id, array('obligatoire', 'optionnelle', 'non enseignée' ), $parc_ue->est_optionnel, ['class' => 'form-control'])
                            !!}
                            {!! $errors->first('statut' . $parc->id, '
                            <small class="help-block">:message</small>
                            ') !!}
                        </div>
                    </td>
                    <td>
                        {!! Form::text('nbmin' . $parc->id, $parc_ue->nbmin, ['class' => 'form-control', 'placeholder' => 'nbmin']) !!}
                        {!! $errors->first('nbmin' . $parc->id, '
                        <small class="help-block">:message</small>
                        ') !!}
                    </td>
                    <td>
                        {!! Form::text('nbmax' . $parc->id, $parc_ue->nbmax, ['class' => 'form-control', 'placeholder' => 'nbmax']) !!}
                        {!! $errors->first('nbmax' . $parc->id, '
                        <small class="help-block">:message</small>
                        ') !!}
                    </td>
                @else
                    <td>
                        <div class="form-group {!! $errors->has('statut' . $parc->id) ? 'has-error' : '' !!}">
                            {!! Form::select('statut' . $parc->id, array('obligatoire', 'optionnelle', 'non enseignée' ), '2', ['class' => 'form-control'])
                            !!}
                            {!! $errors->first('statut' . $parc->id, '
                            <small class="help-block">:message</small>
                            ') !!}
                        </div>
                    </td>
                    <td>
                        {!! Form::text('nbmin' . $parc->id, null, ['class' => 'form-control', 'placeholder' => 'nbmin']) !!}
                        {!! $errors->first('nbmin' . $parc->id, '
                        <small class="help-block">:message</small>
                        ') !!}
                    </td>
                    <td>
                        {!! Form::text('nbmax' . $parc->id, null, ['class' => 'form-control', 'placeholder' => 'nbmax']) !!}
                        {!! $errors->first('nbmax' . $parc->id, '
                        <small class="help-block">:message</small>
                        ') !!}
                    </td>
            @endif
            </tr>
        @endforeach
    </table>
    <div class="form-group">
        {!! Form::submit($texteBtn, ['class' => 'btn btn-info pull-right']) !!}
    </div>
</div>