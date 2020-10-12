<div class="form-group {{ $errors->has('product_id') ? 'has-error' : ''}}">
    <label for="product_id" class="control-label">{{ __('Product') }}</label>
    <select class="form-control selectric" name="product_id">
        @foreach (\App\Product::all() as $item)
        <option value="{{$item->id}}" @if(isset($purchaseitem->product_id))
            @if($purchaseitem->product_id == $item->name) selected @endif
            @endif>
            {{$item->name}}
        </option>
        @endforeach
    </select>
    {!! $errors->first('product_id', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your product ?</div>
</div>
<div class="form-group {{ $errors->has('color_id') ? 'has-error' : ''}}">
    <label for="color_id" class="control-label">{{ __('Color') }}</label>
    <select class="form-control selectric" name="color_id">
        <option value="">---Select---</option>
        @foreach (\App\Color::all() as $item)
        <option value="{{$item->id}}" @if(isset($purchaseitem->color_id))
            @if($purchaseitem->color_id == $item->name) selected @endif
            @endif>
            {{$item->name}}
        </option>
        @endforeach
    </select>

    {!! $errors->first('color_id', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your color ?</div>
</div>
<div class="form-group {{ $errors->has('size_id') ? 'has-error' : ''}}">
    <label for="size_id" class="control-label">{{ __('Size') }}</label>
    <select class="form-control selectric" name="size_id">
        <option value="">---Select---</option>
        @foreach (\App\Color::all() as $item)
        <option value="{{$item->id}}" @if(isset($purchaseitem->size_id))
            @if($purchaseitem->size_id == $item->name) selected @endif
            @endif>
            {{$item->name}}
        </option>
        @endforeach
    </select>
    {!! $errors->first('size_id', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your size ?</div>
</div>
<div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
    <label for="quantity" class="control-label">{{ __('Quantity') }}</label>
    <input class="form-control" name="quantity" type="number" id="quantity" min="1"
        value="{{ isset($purchaseitem->quantity) ? $purchaseitem->quantity : old('quantity')}}" required>
    {!! $errors->first('quantity', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your quantity?</div>
</div>
<div class="form-group {{ $errors->has('regular_price') ? 'has-error' : ''}}">
    <label for="regular_price" class="control-label">{{ __('Regular Price') }}</label>
    <input class="form-control" name="regular_price" type="number" id="regular_price" min="0"
        value="{{ isset($purchaseitem->regular_price) ? $purchaseitem->regular_price : old('regular_price')}}">
    {!! $errors->first('regular_price', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your regular_price?</div>
</div>
<div class="form-group {{ $errors->has('sale_price') ? 'has-error' : ''}}">
    <label for="sale_price" class="control-label">{{ __('Sale Price') }}</label>
    <input class="form-control" name="sale_price" type="number" id="sale_price" min="0"
        value="{{ isset($purchaseitem->sale_price) ? $purchaseitem->sale_price : old('sale_price')}}">
    {!! $errors->first('sale_price', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your sale_price?</div>
</div>
<div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : ''}}">
    <label for="supplier_id" class="control-label">{{ __('Supplier Name') }}</label>
    <select class="form-control selectric" name="supplier_id">
        <option value="">---Select---</option>
        @foreach (\App\Supplier::all() as $item)
        <option value="{{$item->id}}" @if(isset($purchaseitem->supplier_id))
            @if($purchaseitem->supplier_id == $item->name) selected @endif
            @endif>
            {{$item->name}}
        </option>
        @endforeach
    </select>
    {!! $errors->first('supplier_id', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your supplier ?</div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group {{ $errors->has('thumbnail1') ? 'has-error' : ''}}">
            <label for="thumbnail1" class="control-label">{{ __('Thumbnail1') }}</label><br>
            <input type='file' name="thumbnail1" id="imageUpload" accept=".png, .jpg, .jpeg"
                onchange="showMyImage(this,'thumbnail1')"
                value="{{ isset($purchaseitem->thumbnail1) ? $purchaseitem->thumbnail1 : old('image')}}">
            <input type='text' name="oldThumbnail1"
                value="{{ isset($purchaseitem->thumbnail1) ? $purchaseitem->thumbnail1 : ''}}" hidden>
            <div class="avatar-upload">
                <div class="avatar-preview">
                    <img id="thumbnail1" class="avatar-preview"
                        src="{{ isset($purchaseitem->thumbnail1) ? Storage::url($purchaseitem->thumbnail1) : asset('assets/img/upload.png')}}"
                        alt="image" />
                </div>
            </div>
            {!! $errors->first('thumbnail1', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your thumbnail1?</div>
        </div>
    </div>
    <div class="col-6 ">
        <div class="form-group {{ $errors->has('thumbnail2') ? 'has-error' : ''}}">
            <label for="thumbnail2" class="control-label">{{ __('Thumbnail2') }}</label><br>
            <input type='file' name="thumbnail2" id="imageUpload" accept=".png, .jpg, .jpeg"
                onchange="showMyImage(this,'thumbnail2')"
                value="{{ isset($purchaseitem->thumbnail2) ? $purchaseitem->thumbnail2 : old('image')}}">
            <input type='text' name="oldThumbnail2"
                value="{{ isset($purchaseitem->thumbnail2) ? $purchaseitem->thumbnail2 : ''}}" hidden>
            <label for="imageUpload"></label>
            <div class="avatar-upload">
                <div class="avatar-preview">
                    <img id="thumbnail2" class="avatar-preview"
                        src="{{ isset($purchaseitem->thumbnail2) ? Storage::url($purchaseitem->thumbnail2) : asset('assets/img/upload.png')}}"
                        alt="image" />
                </div>
            </div>
            {!! $errors->first('thumbnail2', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your thumbnail2?</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4">
        <div class="form-group {{ $errors->has('image1') ? 'has-error' : ''}}">
            <label for="image1" class="control-label">{{ __('Image1') }}</label><br>
            <input type='file' name="image1" id="imageUpload" accept=".png, .jpg, .jpeg"
                onchange="showMyImage(this,'image1')"
                value="{{ isset($purchaseitem->image1) ? $purchaseitem->image1 : old('image')}}">
            <input type='text' name="oldImage1" value="{{ isset($purchaseitem->image1) ? $purchaseitem->image1 : ''}}"
                hidden>
            <div class="avatar-upload">
                <div class="avatar-edit">
                </div>
                <div class="avatar-preview">
                    <img id="image1" class="avatar-preview"
                        src="{{ isset($purchaseitem->image1) ? Storage::url($purchaseitem->image1) : asset('assets/img/upload.png')}}"
                        alt="image" />
                </div>
            </div>
            {!! $errors->first('image1', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your image1?</div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group {{ $errors->has('image2') ? 'has-error' : ''}}">
            <label for="image2" class="control-label">{{ __('Image2') }}</label><br>
            <input type='file' name="image2" id="imageUpload" accept=".png, .jpg, .jpeg"
                onchange="showMyImage(this,'image2')"
                value="{{ isset($purchaseitem->image2) ? $purchaseitem->image2 : old('image')}}">
            <input type='text' name="oldImage2" value="{{ isset($purchaseitem->image2) ? $purchaseitem->image2 : ''}}"
                hidden>
            <div class="avatar-upload">
                <div class="avatar-preview">
                    <img id="image2" class="avatar-preview"
                        src="{{ isset($purchaseitem->image2) ? Storage::url($purchaseitem->image2) : asset('assets/img/upload.png')}}"
                        alt="image" />
                </div>
            </div>
            {!! $errors->first('image2', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your image2?</div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group {{ $errors->has('image3') ? 'has-error' : ''}}">
            <label for="image3" class="control-label">{{ __('Image3') }}</label><br>
            <input type='file' name="image3" id="imageUpload" accept=".png, .jpg, .jpeg"
                onchange="showMyImage(this,'image3')"
                value="{{ isset($purchaseitem->image3) ? $purchaseitem->image3 : old('image')}}">
            <input type='text' name="oldImage3" value="{{ isset($purchaseitem->image3) ? $purchaseitem->image3 : ''}}"
                hidden>
            <div class="avatar-upload">
                <div class="avatar-preview">
                    <img id="image3" class="avatar-preview"
                        src="{{ isset($purchaseitem->image3) ? Storage::url($purchaseitem->image3) : asset('assets/img/upload.png')}}"
                        alt="image" />
                </div>
            </div>
            {!! $errors->first('image3', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your image3?</div>
        </div>
    </div>

</div>

{{-- <div class="form-group {{ $errors->has('brand_id') ? 'has-error' : ''}}">
<label for="brand_id" class="control-label">{{ __('Brand') }}</label>
<select class="form-control selectric" name="brand_id">
    @foreach (\App\Brand::all() as $item)
    <option value="{{$item->id}}" @if(isset($purchaseitem->brand_id))
        @if($purchaseitem->brand_id == $item->name) selected @endif
        @endif>
        {{$item->name}}
    </option>
    @endforeach
</select>
{!! $errors->first('brand_id', '<p class="text-danger">:message</p>') !!}
<div class="invalid-feedback"> What's your brand ?</div>
</div> --}}
<div class="form-group {{ $errors->has('short_description') ? 'has-error' : ''}}">
    <label for="short_description" class="control-label">{{ __('Short Description') }}</label>
    <textarea class="summernote" rows="5" name="short_description" type="textarea"
        id="short_description">{{ isset($purchaseitem->short_description) ? $purchaseitem->short_description : ''}}</textarea>
    {!! $errors->first('short_description', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your short_description?</div>
</div>
<div class="form-group {{ $errors->has('long_description') ? 'has-error' : ''}}">
    <label for="long_description" class="control-label">{{ __('Long Description') }}</label>
    <textarea class="summernote" rows="5" name="long_description" type="textarea"
        id="long_description">{{ isset($purchaseitem->long_description) ? $purchaseitem->long_description : ''}}</textarea>
    {!! $errors->first('long_description', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your long_description?</div>
</div>


<div class="form-group">
    <input class="btn btn-primary btn-sm oneTimeSubmit" type="submit"
        value="{{ $formMode === 'edit' ? __('Update') : __('Save') }}">
</div>
