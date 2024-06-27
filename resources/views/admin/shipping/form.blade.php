<div class="row">
    <div class="col-md-12">
        <h2 class="fs-1">@if($formMode == "edit"){{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.shipping') }}</h2>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body content-body">
                <div class="form-group{{ $errors->has('country_type') ? 'has-error' : ''}}">
                    {!! Form::label('country_type', __('backend.shipping.area'), ['class' => 'control-label required mb-3']) !!}
                    {!! Form::select('country_type', config('general.country_type'), null,  ['class' => 'form-select', 'data-control' => 'select2', 'data-hide-search' => "true", 'placeholder' => __('backend.shipping.select_country_type'), 'data-placeholder' => "Select Country Type"]) !!}
                    {!! $errors->first('country_type', '<p class="text-danger">:message</p>') !!}
                </div>
                <div class="col-md-12">
                    <div class="mb-3 form-group mt-4{{ $errors->has('amount') ? 'has-error' : ''}}">
                        <div class="list-title mb-3">
                            {!! Form::label('amount', __('backend.shipping.amount'), ['class' => 'control-label required']) !!}
                        </div>
                        <div class="from-group mb-3">
                            <div class="input-group mb-3">
                                <div class="w-100 mw-150px">
                                    {!! Form::select('currency_type', config('general.currency_type'), null, ['class' => 'form-select form-select-solid', 'data-control' => 'select2', 'data-hide-search' => "true", 'data-placeholder' => "Select Payment Method"]) !!}
                                </div>
                                {!! Form::number('amount', null, ('' == 'required') ? ['class' => 'form-control w-100', 'required' => 'required', 'step' => 'any'] : ['class' => 'form-control', 'step' => 'any']) !!}
                            </div>
                        </div>
                        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3 form-group mt-4">
                        <div class="list-title mb-3">
                            {!! Form::label('free_shipping_amount', __('backend.shipping.free_shipping'), ['class' => 'control-label']) !!}
                        </div>
                        <div class="from-group mb-3">
                            <div class="input-group mb-3">
                                <div class="w-100 mw-150px">
                                    {!! Form::select('currency_type', config('general.currency_type'), null, ['class' => 'form-select form-select-solid', 'data-control' => 'select2', 'data-hide-search' => "true", 'data-placeholder' => "Select Payment Method"]) !!}
                                </div>
                                {!! Form::number('free_shipping_amount', null, ('' == 'required') ? ['class' => 'form-control w-100', 'required' => 'required', 'step' => 'any'] : ['class' => 'form-control', 'step' => 'any']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-7">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="form-group">
                        <div class="float-left">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                                {{ __('backend.common.save') }}</button>
                            <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('/admin/shipping') }}'"><i class="bi bi-x"
                                    aria-hidden="true"></i> {{ __('backend.common.cancel') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
