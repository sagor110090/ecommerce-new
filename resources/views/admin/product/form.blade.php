<div class="row">
    <div class="col">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="control-label">{{ __('Name') }}</label>
            <input class="form-control" name="name" type="text" id="name"
                value="{{ isset($product->name) ? $product->name : old('name')}}" required>
            {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your name?</div>
        </div>
    </div>
    <div class="col">
        <div class="form-group {{ $errors->has('sku') ? 'has-error' : ''}}">
            <label for="sku" class="control-label">{{ __('Sku') }}</label>
            <input class="form-control" name="sku" type="text" id="sku"
                value="{{ isset($product->sku) ? $product->sku : old('sku')}}">
            {!! $errors->first('sku', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your sku?</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
            <label for="category_id" class="control-label">{{ __('Category') }}</label>
            <select class="form-control selectric" name="category_id" id="category_id" onchange="subCategorySearch()">
                @foreach (\App\Category::all() as $item)
                <option value="{{$item->id}}" @if(isset($product->category_id))
                    @if($product->category_id == $item->id) selected @endif
                    @endif>
                    {{$item->name}}
                </option>
                @endforeach
            </select>
            {!! $errors->first('category_id', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your category?</div>
        </div>
    </div>
    <div class="col">
        <div class="form-group {{ $errors->has('subcategory_id') ? 'has-error' : ''}}">
            <label for="subcategory_id" class="control-label">{{ __('Sub Category') }}</label>
            <select class="form-control" name="subcategory_id" id='subcategory_id' onchange="miniCategorySearch()">
                @if(isset($product->subcategory_id))
                <option value="{{$product->subCategory->id}}">{{$product->subCategory->name}}</option>
                @else
                <option value="">---Select---</option>
                @endif
            </select>
            {!! $errors->first('subcategory', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your subcategory?</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group {{ $errors->has('minicategory_id') ? 'has-error' : ''}}">
            <label for="minicategory_id" class="control-label">{{ __('Mini Category') }}</label>
            <select class="form-control" name="minicategory_id" id='minicategory_id'>
                @if(isset($product->minicategory_id))
                <option value="{{$product->miniCategory->id}}">{{$product->miniCategory->name}}</option>
                @else
                <option value="">---Select---</option>
                @endif
            </select>
            {!! $errors->first('minicategory_id', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your minicategory?</div>
        </div>

    </div>
    <div class="col">
        <div class="form-group {{ $errors->has('type_id') ? 'has-error' : ''}}">
            <label for="type_id" class="control-label">{{ __('Type') }}</label>
            <select class="form-control selectric" name="type_id">
                @foreach (\App\Type::all() as $item)
                <option value="{{$item->id}}" @if(isset($product->type_id))
                    @if($product->type_id == $item->id) selected @endif
                    @endif>
                    {{$item->name}}
                </option>
                @endforeach
            </select>
            {!! $errors->first('type_id', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your type ?</div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group {{ $errors->has('brand_id') ? 'has-error' : ''}}">
            <label for="brand_id" class="control-label">{{ __('Brand ') }}</label>
            <select class="form-control selectric" name="brand_id">
                @foreach (\App\Brand::all() as $item)
                <option value="{{$item->id}}" @if(isset($product->brand_id))
                    @if($product->brand_id == $item->id) selected @endif
                    @endif>
                    {{$item->name}}
                </option>
                @endforeach
            </select>
            {!! $errors->first('brand_id', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your brand ?</div>
        </div>

    </div>
    <div class="col">
        <div class="form-group {{ $errors->has('featured') ? 'has-error' : ''}}">
            <label for="featured" class="control-label">{{ __('Ordinary') }}</label>
            <select class="form-control selectric" name="featured">
                <option value="no">Not ordinary</option>
                <option value="yes">ordinary</option>
            </select>
            {!! $errors->first('featured', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your ordinary?</div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group {{ $errors->has('color_id') ? 'has-error' : ''}}">
            <label for="color_id" class="control-label">{{ __('Color') }}</label>
            <select class="form-control selectric" name="color_id">
                <option value="">---Select---</option>
                @foreach (\App\Color::all() as $item)
                <option value="{{$item->id}}" @if(isset($product->color_id))
                    @if($product->color_id == $item->id) selected @endif
                    @endif>
                    {{$item->name}}
                </option>
                @endforeach
            </select>

            {!! $errors->first('color_id', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your color ?</div>
        </div>

    </div>
    <div class="col">
        <div class="form-group {{ $errors->has('size_id') ? 'has-error' : ''}}">
            <label for="size_id" class="control-label">{{ __('Size') }}</label>
            <select class="form-control selectric" name="size_id">
                <option value="">---Select---</option>
                @foreach (\App\Color::all() as $item)
                <option value="{{$item->id}}" @if(isset($product->size_id))
                    @if($product->size_id == $item->id) selected @endif
                    @endif>
                    {{$item->name}}
                </option>
                @endforeach
            </select>
            {!! $errors->first('size_id', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your size ?</div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
            <label for="quantity" class="control-label">{{ __('Quantity') }}</label>
            <input class="form-control" name="quantity" type="number" id="quantity" min="1"
                value="{{ isset($product->quantity) ? $product->quantity : old('quantity')}}" required>
            {!! $errors->first('quantity', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your quantity?</div>
        </div>

    </div>
    <div class="col">
        <div class="form-group {{ $errors->has('regular_price') ? 'has-error' : ''}}">
            <label for="regular_price" class="control-label">{{ __('Regular Price') }}</label>
            <input class="form-control" name="regular_price" type="number" id="regular_price" min="0"
                value="{{ isset($product->regular_price) ? $product->regular_price : old('regular_price')}}">
            {!! $errors->first('regular_price', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your regular_price?</div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group {{ $errors->has('sale_price') ? 'has-error' : ''}}">
            <label for="sale_price" class="control-label">{{ __('Sale Price') }}</label>
            <input class="form-control" name="sale_price" type="number" id="sale_price" min="0"
                value="{{ isset($product->sale_price) ? $product->sale_price : old('sale_price')}}">
            {!! $errors->first('sale_price', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your sale_price?</div>
        </div>

    </div>
    <div class="col">

        <div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : ''}}">
            <label for="supplier_id" class="control-label">{{ __('Supplier Name') }}</label>
            <select class="form-control selectric" name="supplier_id">
                <option value="">---Select---</option>
                @foreach (\App\Supplier::all() as $item)
                <option value="{{$item->id}}" @if(isset($product->supplier_id))
                    @if($product->supplier_id == $item->id) selected @endif
                    @endif>
                    {{$item->name}}
                </option>
                @endforeach
            </select>
            {!! $errors->first('supplier_id', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your supplier ?</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group {{ $errors->has('thumbnail1') ? 'has-error' : ''}}">
            <label for="thumbnail1" class="control-label">{{ __('Thumbnail1') }}</label><br>
            <input type='file' name="thumbnail1" accept=".png, .jpg, .jpeg" onchange="showMyImage(this,'thumbnail1')"
                value="{{ isset($product->thumbnail1) ? $product->thumbnail1 : old('image')}}">
            <input type='text' name="oldThumbnail1" value="{{ isset($product->thumbnail1) ? $product->thumbnail1 : ''}}"
                hidden>
            <div class="avatar-upload">
                <div class="avatar-preview">
                    <img id="thumbnail1" class="avatar-preview"
                        src="{{ isset($product->thumbnail1) ? Storage::url($product->thumbnail1) : asset('assets/img/upload.png')}}"
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
            <input type='file' name="thumbnail2" accept=".png, .jpg, .jpeg" onchange="showMyImage(this,'thumbnail2')"
                value="{{ isset($product->thumbnail2) ? $product->thumbnail2 : old('image')}}">
            <input type='text' name="oldThumbnail2" value="{{ isset($product->thumbnail2) ? $product->thumbnail2 : ''}}"
                hidden>
            <label f></label>
            <div class="avatar-upload">
                <div class="avatar-preview">
                    <img id="thumbnail2" class="avatar-preview"
                        src="{{ isset($product->thumbnail2) ? Storage::url($product->thumbnail2) : asset('assets/img/upload.png')}}"
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
            <input type='file' name="image1" accept=".png, .jpg, .jpeg" onchange="showMyImage(this,'image1')"
                value="{{ isset($product->image1) ? $product->image1 : old('image')}}">
            <input type='text' name="oldImage1" value="{{ isset($product->image1) ? $product->image1 : ''}}" hidden>
            <div class="avatar-upload">
                <div class="avatar-edit">
                </div>
                <div class="avatar-preview">
                    <img id="image1" class="avatar-preview"
                        src="{{ isset($product->image1) ? Storage::url($product->image1) : asset('assets/img/upload.png')}}"
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
            <input type='file' name="image2" accept=".png, .jpg, .jpeg" onchange="showMyImage(this,'image2')"
                value="{{ isset($product->image2) ? $product->image2 : old('image')}}">
            <input type='text' name="oldImage2" value="{{ isset($product->image2) ? $product->image2 : ''}}" hidden>
            <div class="avatar-upload">
                <div class="avatar-preview">
                    <img id="image2" class="avatar-preview"
                        src="{{ isset($product->image2) ? Storage::url($product->image2) : asset('assets/img/upload.png')}}"
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
            <input type='file' name="image3" accept=".png, .jpg, .jpeg" onchange="showMyImage(this,'image3')"
                value="{{ isset($product->image3) ? $product->image3 : old('image')}}">
            <input type='text' name="oldImage3" value="{{ isset($product->image3) ? $product->image3 : ''}}" hidden>
            <div class="avatar-upload">
                <div class="avatar-preview">
                    <img id="image3" class="avatar-preview"
                        src="{{ isset($product->image3) ? Storage::url($product->image3) : asset('assets/img/upload.png')}}"
                        alt="image" />
                </div>
            </div>
            {!! $errors->first('image3', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your image3?</div>
        </div>
    </div>

</div>

<div class="form-group {{ $errors->has('short_description') ? 'has-error' : ''}}">
    <label for="short_description" class="control-label">{{ __('Short Description') }}</label>
    <textarea class="form-control" rows="10" name="short_description" type="textarea"
        id="short_description">{{ isset($product->short_description) ? $product->short_description : ''}}</textarea>
    {!! $errors->first('short_description', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your short_description?</div>
</div>
<div class="form-group {{ $errors->has('long_description') ? 'has-error' : ''}}">
    <label for="long_description" class="control-label">{{ __('Long Description') }}</label>
    <textarea class="summernote" rows="5" name="long_description" type="textarea"
        id="long_description">{{ isset($product->long_description) ? $product->long_description : ''}}</textarea>
    {!! $errors->first('long_description', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your long_description?</div>
</div>
<div class="form-group">
    <input class="btn btn-primary btn-sm oneTimeSubmit" type="submit"
        value="{{ $formMode === 'edit' ? __('Update') : __('Save') }}">
</div>
