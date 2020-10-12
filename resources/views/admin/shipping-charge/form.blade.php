<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ __('Name') }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($shippingcharge->name) ? $shippingcharge->name : old('name')}}" required>
    {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your name?</div>
</div>
<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="control-label">{{ __('Amount') }}</label>
    <input class="form-control" name="amount" type="number" id="amount" value="{{ isset($shippingcharge->amount) ? $shippingcharge->amount : old('amount')}}" required>
    {!! $errors->first('amount', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your amount?</div>
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ __('Status') }}</label>
    <select name="status" id="status" class="form-control">
        <option value="active">Active</option>
        <option value="not active">Not Active</option>
    </select>
    {!! $errors->first('status', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your status?</div>
</div>


<div class="form-group">
    <input class="btn btn-primary btn-sm oneTimeSubmit" type="submit" value="{{ $formMode === 'edit' ? __('Update') : __('Save') }}">
</div>
