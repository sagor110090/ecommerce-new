<div class="row">
    <div class="col">
        <div class="form-group {{ $errors->has('slider_background') ? 'has-error' : ''}}">
            <label for="slider_background" class="control-label">{{ __('Slider Background') }}</label>
            <div class="avatar-upload">
                <input type='file' name="slider_background" accept=".png, .jpg, .jpeg"
                    onchange="showMyImage(this,'slider_background')"
                    value="{{ isset($slider->slider_background) ? $slider->slider_background : old('image')}}">
                <input type='text' name="oldImage"
                    value="{{ isset($slider->slider_background) ? $slider->slider_background : ''}}" hidden>

                <div class="avatar-preview">
                    <img id="slider_background" class="avatar-preview"
                        src="{{ isset($slider->slider_background) ? Storage::url($slider->slider_background) : asset('assets/img/upload.png')}}"
                        alt="image" />
                </div>
            </div>
            {!! $errors->first('slider_background', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your slider_background?</div>
        </div>
    </div>
    <div class="col">
        <div class="form-group {{ $errors->has('slider_lable1') ? 'has-error' : ''}}">
            <label for="slider_lable1" class="control-label">{{ __('Slider Lable1') }}</label>
            <div class="avatar-upload">
                <input type='file' name="slider_lable1" accept=".png, .jpg, .jpeg"
                    onchange="showMyImage(this,'slider_lable1')"
                    value="{{ isset($slider->slider_lable1) ? $slider->slider_lable1 : old('image')}}">
                <input type='text' name="oldImage"
                    value="{{ isset($slider->slider_lable1) ? $slider->slider_lable1 : ''}}" hidden>

                <div class="avatar-preview">
                    <img id="slider_lable1" class="avatar-preview"
                        src="{{ isset($slider->slider_lable1) ? Storage::url($slider->slider_lable1) : asset('assets/img/upload.png')}}"
                        alt="image" />
                </div>
            </div>
            {!! $errors->first('slider_lable1', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your slider_lable1?</div>
        </div>
    </div>
    <div class="col">
        <div class="form-group {{ $errors->has('slider_lable2') ? 'has-error' : ''}}">
            <label for="slider_lable2" class="control-label">{{ __('Slider Lable2') }}</label>
            <div class="avatar-upload">
                <input type='file' name="slider_lable2" accept=".png, .jpg, .jpeg"
                    onchange="showMyImage(this,'slider_lable2')"
                    value="{{ isset($slider->slider_lable2) ? $slider->slider_lable2 : old('image')}}">
                <input type='text' name="oldImage"
                    value="{{ isset($slider->slider_lable2) ? $slider->slider_lable2 : ''}}" hidden>

                <div class="avatar-preview">
                    <img id="slider_lable2" class="avatar-preview"
                        src="{{ isset($slider->slider_lable2) ? Storage::url($slider->slider_lable2) : asset('assets/img/upload.png')}}"
                        alt="image" />
                </div>
            </div>
            {!! $errors->first('slider_lable2', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your slider_lable2?</div>
        </div>
    </div>
    <div class="col">
        <div class="form-group {{ $errors->has('slider_lable3') ? 'has-error' : ''}}">
            <label for="slider_lable3" class="control-label">{{ __('Slider Lable3') }}</label>
            <div class="avatar-upload">
                <input type='file' name="slider_lable3" accept=".png, .jpg, .jpeg"
                    onchange="showMyImage(this,'slider_lable3')"
                    value="{{ isset($slider->slider_lable3) ? $slider->slider_lable3 : old('image')}}">
                <input type='text' name="oldImage"
                    value="{{ isset($slider->slider_lable3) ? $slider->slider_lable3 : ''}}" hidden>

                <div class="avatar-preview">
                    <img id="slider_lable3" class="avatar-preview"
                        src="{{ isset($slider->slider_lable3) ? Storage::url($slider->slider_lable3) : asset('assets/img/upload.png')}}"
                        alt="image" />
                </div>
            </div>
            {!! $errors->first('slider_lable3', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your slider_lable3?</div>
        </div>
    </div>
    <div class="col">

        <div class="form-group {{ $errors->has('slider_lable4') ? 'has-error' : ''}}">
            <label for="slider_lable4" class="control-label">{{ __('Slider Lable4') }}</label>
            <div class="avatar-upload">
                <input type='file' name="slider_lable4" accept=".png, .jpg, .jpeg"
                    onchange="showMyImage(this,'slider_lable4')"
                    value="{{ isset($slider->slider_lable4) ? $slider->slider_lable4 : old('image')}}">
                <input type='text' name="oldImage"
                    value="{{ isset($slider->slider_lable4) ? $slider->slider_lable4 : ''}}" hidden>

                <div class="avatar-preview">
                    <img id="slider_lable4" class="avatar-preview"
                        src="{{ isset($slider->slider_lable4) ? Storage::url($slider->slider_lable4) : asset('assets/img/upload.png')}}"
                        alt="image" />
                </div>
            </div>
            {!! $errors->first('slider_lable4', '<p class="text-danger">:message</p>') !!}
            <div class="invalid-feedback"> What's your slider_lable4?</div>
        </div>
    </div>
</div>




<div class="form-group {{ $errors->has('header') ? 'has-error' : ''}}">
    <label for="header" class="control-label">{{ __('Header') }}</label>
    <input class="form-control" name="header" type="text" id="header"
        value="{{ isset($slider->header) ? $slider->header : old('header')}}" required>
    {!! $errors->first('header', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your header?</div>
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ __('Description') }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea"
        id="description">{{ isset($slider->description) ? $slider->description : ''}}</textarea>
    {!! $errors->first('description', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your description?</div>
</div>



<div class="form-group">
    <input class="btn btn-primary btn-sm oneTimeSubmit" type="submit"
        value="{{ $formMode === 'edit' ? __('Update') : __('Save') }}">
</div>
