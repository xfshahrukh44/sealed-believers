<div class="form-body">
    <div class="row">
        <input type="hidden" name="user_id" id="user_id" value="{{ $requestinterview->user_id }}">
		<div class="col-md-12">
    <div class="form-group">
    	{!! Form::label('subject', 'Subject') !!}
    	    	{!! Form::text('subject', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    </div>
</div>
<!--<div class="col-md-12">-->
<!--    <div class="form-group">-->
<!--    	{!! Form::label('user_id', 'User Id') !!}-->
<!--    	    	{!! Form::number('user_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}-->
<!--    </div>-->
<!--</div>-->
<div class="col-md-12">
    <div class="form-group">
    	{!! Form::label('user_id', 'Select User') !!}
        <select class="form-control" id="user_id" name="user_id">
            @php
            $user = App\User::all();
            @endphp
            <option value="" selected>Select User</option>
            @foreach($user as $value)
            @if($value->id != 1)
            <option value="{{ $value->id }}" {{ ($requestinterview->user_id == $value->id) ? 'selected' : '' }}>{{ $value->name }}</option>
            @endif
            @endforeach
        </select>
    </div>
</div><div class="col-md-12">
    <div class="form-group">
    	{!! Form::label('details', 'Details') !!}
    		{!! Form::textarea('details', null, ('' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor', 'required' => 'required'] : ['class' => 'form-control', 'id' => 'summary-ckeditor']) !!}
    </div>
</div>
	</div>
</div>
<div class="form-actions text-right pb-0">
    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
