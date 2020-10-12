<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ __('Name') }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($blog->name) ? $blog->name : old('name')}}" required>
    {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your name?</div>
</div>
<div class="form-group {{ $errors->has('thumbnail') ? 'has-error' : ''}}">
    <label for="thumbnail" class="control-label">{{ __('Thumbnail') }}</label>
    <input class="form-control" name="thumbnail" type="file" id="thumbnail" value="{{ isset($blog->thumbnail) ? $blog->thumbnail : old('thumbnail')}}" >
    {!! $errors->first('thumbnail', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your thumbnail?</div>
</div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ __('Image') }}</label>
    <input class="form-control" name="image" type="file" id="image" value="{{ isset($blog->image) ? $blog->image : old('image')}}" >
    {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your image?</div>
</div>
<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    <label for="content" class="control-label">{{ __('Content') }}</label>
    <textarea class="form-control" rows="15" name="content" type="textarea" id="content" required>{{ isset($blog->content) ? $blog->content : old('content')}}</textarea>
    {!! $errors->first('content', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your content?</div>
</div>


<div class="form-group">
    <input class="btn btn-primary btn-sm oneTimeSubmit" type="submit" value="{{ $formMode === 'edit' ? __('Update') : __('Save') }}">
</div>
