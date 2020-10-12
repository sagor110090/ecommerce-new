<div class="form-group {{ $errors->has('product_id') ? 'has-error' : ''}}">
    <label for="product_id" class="control-label">{{ __('Product Id') }}</label>
        <select class="form-control selectric" name="product_id">
            @foreach (\App\Product::all() as $item)
            <option value="{{$item->id}}" @if(isset($offer->product_id))
                @if($offer->product_id == $item->name) selected @endif
                @endif>
                {{$item->name}}
            </option>
            @endforeach
        </select>
    {!! $errors->first('product_id', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your product ?</div>
</div>
<div class="form-group {{ $errors->has('ending_date_time') ? 'has-error' : ''}}">
    <label for="ending_date_time" class="control-label">{{ __('Ending Date Time') }}</label><br>
    {{ isset($offer->ending_date_time) ? $offer->ending_date_time : ''}}
    <input class="form-control{{ $errors->has('ending_date_time') ? ' is-invalid' : '' }}" name="ending_date_time"
        type="datetime-local" id="ending_date_time"
        value="{{ isset($offer->ending_date_time) ? $offer->ending_date_time : old('ending_date_time')}}"
        placeholder="{{ __('ending_date_time') }}" required>
    {!! $errors->first('ending_date_time', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your ending date time?</div>
</div>
<div class="form-group {{ $errors->has('offer_percentage') ? 'has-error' : ''}}">
    <label for="offer_percentage" class="control-label">{{ __('Offer Percentage %') }}</label>
    <input class="form-control" name="offer_percentage" type="number" id="offer_percentage"
        value="{{ isset($offer->offer_percentage) ? $offer->offer_percentage : old('offer_percentage')}}" required>
    {!! $errors->first('offer_percentage', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your offer percentage?</div>
</div>


<div class="form-group">
    <input class="btn btn-primary btn-sm oneTimeSubmit" type="submit"
        value="{{ $formMode === 'edit' ? __('Update') : __('Save') }}">
</div>
