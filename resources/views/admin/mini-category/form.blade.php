<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ __('Name') }}</label>
    <input class="form-control" name="name" type="text" id="name"
        value="{{ isset($minicategory->name) ? $minicategory->name : old('name')}}" required>
    {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your name?</div>
</div>
<div class="form-group {{ $errors->has('subCategory_id') ? 'has-error' : ''}}">
    <label for="subCategory_id" class="control-label">{{ __('Sub Category') }}</label>
    <select class="form-control selectric" name="subCategory_id">
        @foreach (\App\SubCategory::all() as $item)
        <option value="{{$item->id}}" @if(isset($minicategory->subCategory_id))
            @if($minicategory->subCategory_id == $item->id) selected @endif
            @endif>
            {{$item->name}}
        </option>
        @endforeach
    </select>
    {!! $errors->first('subCategory_id', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your sub Category?</div>
</div>


<div class="form-group">
    <input class="btn btn-primary btn-sm oneTimeSubmit" type="submit"
        value="{{ $formMode === 'edit' ? __('Update') : __('Save') }}">
</div>
