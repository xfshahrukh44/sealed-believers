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
        {!! Form::label('video', 'Upload Video') !!}
        <input class="form-control dropify" name="video" type="file" id="video"
            {{ $interviewvideo->video != '' ? "data-default-file = /$interviewvideo->video" : '' }}
            value="{{ $interviewvideo->video }}">
    </div>
</div>
	</div>
</div>
<div class="form-actions text-right pb-0">
    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
