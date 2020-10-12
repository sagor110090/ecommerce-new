<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ __('Name') }}</label>
    <input class="form-control" name="name" type="text" id="name"
        value="{{ isset($category->name) ? $category->name : old('name')}}" required>
    {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your name?</div>
</div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ __('Image') }}</label>
    <div class="avatar-upload">
        <div class="avatar-edit">
            <input type='file' name="image" id="imageUpload" accept=".png, .jpg, .jpeg"
                onchange="showMyImage(this,'category')"
                value="{{ isset($category->image) ? $category->image : old('image')}}">
            <input type='text' name="oldImage" value="{{ isset($category->image) ? $category->image : ''}}" hidden>
            <label for="imageUpload"></label>
        </div>
        <div class="avatar-preview">
            <img id="category" class="avatar-preview"
                src="{{ isset($category->image) ? Storage::url($category->image) : asset('assets/img/upload.png')}}"
                alt="image" />
        </div>
    </div>
    {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your image?</div>
</div>


<div class="form-group">
    <input class="btn btn-primary btn-sm oneTimeSubmit" type="submit"
        value="{{ $formMode === 'edit' ? __('Update') : __('Save') }}">
</div>
