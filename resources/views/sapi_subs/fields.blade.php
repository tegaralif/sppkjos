<!-- Pemasok1 Id Field -->
<div class="form-group col-sm-3">
    {!! Form::label('sapi1_id', 'Sapi 2:') !!}
    {!! Form::text('', $sapi1->nama_sapi, ['class' => 'form-control', 'disabled']) !!}
    {!! Form::hidden('sapi1_id', $sapi1->id) !!}
</div>

<!-- Nilai Field -->
<div class="form-group col-sm-3">
    {!! Form::label('nilai', 'Nilai:') !!}
    {!! Form::text('nilai', null, ['class' => 'form-control', 'autofocus']) !!}
</div>

<!-- Pemasok2 Id Field -->
<div class="form-group col-sm-3">
    {!! Form::label('sapi2_id', 'Sapi 2:') !!}
    {!! Form::text('', $sapi2->nama_sapi, ['class' => 'form-control', 'disabled']) !!}
    {!! Form::hidden('sapi2_id', $sapi2->id) !!}
</div>

    {!! Form::hidden('kriteria_id', $subKriteria->kriteria_id) !!}

    {!! Form::hidden('expert_id', $expert->id) !!}

    {!! Form::hidden('sub_kriteria_id', $subKriteria->id)!!}

<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
