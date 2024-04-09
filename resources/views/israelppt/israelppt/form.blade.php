<div class="form-body">
    <div class="row">
		<div class="col-md-12">
    <div class="form-group">
    	{!! Form::label('title', 'Title') !!}
    	    	{!! Form::text('title', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        {!! Form::label('ppt', 'Upload PPT') !!}
        <input class="form-control dropify" name="ppt" type="file" id="ppt"
            {{ $israelppt->ppt != '' ? "data-default-file = /$israelppt->ppt" : '' }}
            value="{{ $israelppt->ppt }}">
    </div>
</div>
	</div>
</div>
<div class="form-actions text-right pb-0">
    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
