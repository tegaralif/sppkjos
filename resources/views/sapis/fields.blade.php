<!-- Nama Sapi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama_sapi', 'Nama Sapi:') !!}
    {!! Form::text('nama_sapi', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('sapis.index') !!}" class="btn btn-default">Cancel</a>
</div>
