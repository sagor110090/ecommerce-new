<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ __('Name') }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($supplier->name) ? $supplier->name : old('name')}}" required>
    {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your name?</div>
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="control-label">{{ __('Address') }}</label>
    <textarea class="form-control" rows="5" name="address" type="textarea" id="address" required>{{ isset($supplier->address) ? $supplier->address : ''}}</textarea>
    {!! $errors->first('address', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your address?</div>
</div>
<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
    <label for="phone_number" class="control-label">{{ __('Phone Number') }}</label>
    <input class="form-control" name="phone_number" type="text" id="phone_number" value="{{ isset($supplier->phone_number) ? $supplier->phone_number : old('phone_number')}}" required>
    {!! $errors->first('phone_number', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your phone_number?</div>
</div>
<div class="form-group {{ $errors->has('total_paid_amount') ? 'has-error' : ''}}">
    <label for="total_paid_amount" class="control-label">{{ __('Total Paid Amount') }}</label>
    <input class="form-control" name="total_paid_amount" type="number" id="total_paid_amount" value="{{ isset($supplier->total_paid_amount) ? $supplier->total_paid_amount : old('total_paid_amount')}}" >
    {!! $errors->first('total_paid_amount', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your total_paid_amount?</div>
</div>
<div class="form-group {{ $errors->has('total_paid_due') ? 'has-error' : ''}}">
    <label for="total_paid_due" class="control-label">{{ __('Total Paid Due') }}</label>
    <input class="form-control" name="total_paid_due" type="number" id="total_paid_due" value="{{ isset($supplier->total_paid_due) ? $supplier->total_paid_due : old('total_paid_due')}}" >
    {!! $errors->first('total_paid_due', '<p class="text-danger">:message</p>') !!}
    <div class="invalid-feedback"> What's your total_paid_due?</div>
</div>


<div class="form-group">
    <input class="btn btn-primary btn-sm oneTimeSubmit" type="submit" value="{{ $formMode === 'edit' ? __('Update') : __('Save') }}">
</div>
