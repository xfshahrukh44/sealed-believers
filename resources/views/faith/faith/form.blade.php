<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="form-group">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text(
                    'name',
                    null,
                    '' == 'required' ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control'],
                ) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('short_desc', 'Short Description') !!}
                {!! Form::textarea(
                    'short_desc',
                    null,
                    '' == 'required'
                        ? ['class' => 'form-control', 'id' => 'summary-ckeditor', 'required' => 'required']
                        : ['class' => 'form-control', 'id' => 'summary-ckeditor'],
                ) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea(
                    'description',
                    null,
                    '' == 'required'
                        ? ['class' => 'form-control', 'id' => 'summary-ckeditor1', 'required' => 'required']
                        : ['class' => 'form-control', 'id' => 'summary-ckeditor1'],
                ) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('image', 'Image') !!}
                <input class="form-control dropify" name="image" type="file" id="image"
                    {{ $faith->image != '' ? "data-default-file = /$faith->image" : '' }}
                    {{ $faith->image == '' ? 'required' : '' }} value="{{ $faith->image }}">
            </div>
        </div>
    </div>
</div>
<div class="form-actions text-right pb-0">
    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
