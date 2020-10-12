<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ __('Name') }}</label>
    <input class="form-control" name="name" type="text" id="name"
        value="{{ isset($subcategory->name) ? $subcategory->name : old('name')}}" required>
    {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your name?</div>
</div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ __('Image') }}</label>
    <div class="avatar-upload">
        <div class="avatar-edit">
            <input type='file' name="image" id="imageUpload" accept=".png, .jpg, .jpeg"
                onchange="showMyImage(this,'subcategory')"
                value="{{ isset($subcategory->image) ? $subcategory->image : old('image')}}">
            <input type='text' name="oldImage" value="{{ isset($subcategory->image) ? $subcategory->image : ''}}"
                hidden>
            <label for="imageUpload"></label>
        </div>
        <div class="avatar-preview">
            <img id="subcategory" class="avatar-preview"
                src="{{ isset($subcategory->image) ? Storage::url($subcategory->image) : asset('assets/img/upload.png')}}"
                alt="image" />
        </div>
    </div>
    {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your image?</div>
</div>
<div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
    <label for="category_id" class="control-label">{{ __('Category') }}</label>
    <select class="form-control selectric" name="category_id">
        @foreach (\App\Category::all() as $item)
        <option value="{{$item->id}}" @if(isset($subcategory->category_id))
            @if($subcategory->category_id == $item->id) selected @endif
            @endif>
            {{$item->name}}
        </option>
        @endforeach
    </select>
    {!! $errors->first('category_id', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your category_id?</div>
</div>


<div class="form-group">
    <input class="btn btn-primary btn-sm oneTimeSubmit" type="submit"
        value="{{ $formMode === 'edit' ? __('Update') : __('Save') }}">
</div>
