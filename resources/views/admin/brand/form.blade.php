<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ __('Name') }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($brand->name) ? $brand->name : old('name')}}" required>
    {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your name?</div>
</div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ __('image') }}</label><br>
    <input type='file' name="image" accept=".png, .jpg, .jpeg" onchange="showMyImage(this,'image')"
        value="{{ isset($brand->image) ? $brand->image : old('image')}}">
    <div class="avatar-upload">
        <div class="avatar-edit">
        </div>
        <div class="avatar-preview">
            <img id="image" class="avatar-preview"
                src="{{ isset($brand->image) ? Storage::url($brand->image) : asset('assets/img/upload.png')}}"
                alt="image" />
        </div>
    </div>
    {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your image?</div>
</div>

<div class="form-group">
    <input class="btn btn-primary btn-sm oneTimeSubmit" type="submit" value="{{ $formMode === 'edit' ? __('Update') : __('Save') }}">
</div>
