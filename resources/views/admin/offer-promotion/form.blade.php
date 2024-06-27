<div class="row">
    <div class="col-md-12">
        <h2 class="fs-1">@if($formMode == "edit") {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.offer_promotion') }}</h2>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header" style="min-height: 0px;padding:0px;">
                <ul class="nav nav-pills nav-fill">
                    @foreach (config('locale.langs') as $lngcode => $lng)
                        <li class="nav-item">
                            <a class="nav-link {{ $lngcode == 'en' ? 'active' : '' }} nav_link" data-bs-toggle="tab" href="#{{ strtolower($lngcode) }}-tab" style="border-radius: 7px 7px 1px 1px;">
                                <span class="d-sm-none fs-5">{{ $lng }}</span>
                                <span class="d-sm-block d-none fs-5">{{ $lng }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-body content-body">
                <div class="tab-content">   
                    @foreach (config('locale.langs') as $lng => $attr)
                    <div class="tab-pane fade {{ $lng == 'en' ? 'active show' : '' }}"  id="{{ strtolower($lng) }}-tab">      
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('name_'.$lng) ? 'has-error' : ''}}">
                                    @foreach (config('locale.langs_code') as $key => $code)
                                        @if ($lng == $key)
                                            {!! Form::label('name_'.$lng, __('backend.offer_promotion.name').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                        @endif
                                    @endforeach
                                    {!! Form::text('name_'.$lng, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                    {!! $errors->first('name_'.$lng, '<p class="text-danger">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('description_'.$lng) ? 'has-error' : ''}}">
                                    @foreach (config('locale.langs_code') as $key => $code)
                                        @if ($lng == $key)
                                            {!! Form::label('description_'.$lng, __('backend.offer_promotion.description').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                        @endif
                                    @endforeach
                                    {!! Form::textarea('description_'.$lng, isset($offerpromotion) && isset($offerpromotion->descriptions[$lng]) ? $offerpromotion->descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                    {!! $errors->first('description_'.$lng, '<p class="text-danger">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{-- <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('amount') ? 'has-error' : ''}}">
                                {!! Form::label('amount', __('backend.offer_promotion.amount'), ['class' => 'control-label mb-3']) !!}
                                {!! Form::number('amount', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'step' => 'any'] : ['class' => 'form-control', 'step' => 'any']) !!}
                                {!! $errors->first('amount', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('percent') ? 'has-error' : ''}}">
                                {!! Form::label('percent', __('backend.offer_promotion.percent'), ['class' => 'control-label mb-3']) !!}
                                {!! Form::number('percent', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'step' => 'any'] : ['class' => 'form-control', 'step' => 'any']) !!}
                                {!! $errors->first('percent', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div> --}}
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('amount_type') ? 'has-error' : ''}}">
                                {!! Form::label('type', __('backend.offer_promotion.type'), ['class' => 'control-label mb-3']) !!}
                                {!! Form::select('amount_type', config('general.amount_type'), isset($offerpromotion) ? ($offerpromotion->is_percent == 1 ? 1 : 0) : null, ['class' => 'form-select', 'data-control' => 'select2', 'data-hide-search' => "true", 'placeholder' => 'Select Discount Type', 'data-placeholder' => __('backend.offer_promotion.select_type')]) !!}
                                {!! $errors->first('amount_type', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="amount-type form-group{{ $errors->has('amount') ? 'has-error' : ''}} {{ isset($offerpromotion) && isset($offerpromotion->amount) ? '' : 'd-none' }}">
                                {!! Form::label('amount', __('backend.offer_promotion.amount'), ['class' => 'control-label mb-3']) !!}
                                {!! Form::number('amount', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="percent-type form-group{{ $errors->has('percent') ? 'has-error' : ''}} {{ isset($offerpromotion) && isset($offerpromotion->percent) ? '' : 'd-none' }}">
                                {!! Form::label('percent', __('backend.offer_promotion.percent'), ['class' => 'control-label mb-3']) !!}
                                {!! Form::number('percent', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                {!! $errors->first('percent', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('start_date') ? 'has-error' : ''}}">
                                {!! Form::label('start_date', __('backend.offer_promotion.start_date'), ['class' => 'control-label mb-3']) !!}
                                {!! Form::input('datetime-local', 'start_date', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                {!! $errors->first('start_date', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('end_date') ? 'has-error' : ''}}">
                                {!! Form::label('end_date', __('backend.offer_promotion.end_date'), ['class' => 'control-label mb-3']) !!}
                                {!! Form::input('datetime-local', 'end_date', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                {!! $errors->first('end_date', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    {{ __('backend.offer_promotion.type') }}
                </div>
            </div>
            <div class="card-body">
                <select class="form-select" name="amount_type" data-control="select2" data-hide-search="true" data-placeholder="{{ __('backend.offer_promotion.select_type') }}">
                    <option></option>
                    @foreach (config('general.amount_type') as $key => $value)
                        <option value="{{ $key }}" @if(isset($offerpromotion) && $offerpromotion->is_percent == $key) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div> --}}
</div>
<div class="row mt-4">
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-group">
                <div class="float-left">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                        {{ __('backend.common.save') }}</button>
                    <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('admin/offer-promotion') }}'"><i class="bi bi-x"
                            aria-hidden="true"></i> {{ __('backend.common.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('select[name="amount_type"]').on('select2:select', function () {
            var type  = $(this).val();

            $('.amount-type').addClass('d-none');
            $('.percent-type').addClass('d-none');

            if (type == "0") {
                $('.amount-type').removeClass('d-none');
                $('input[name="percent"]').val('');
            }

            if (type == "1") {
                $('.percent-type').removeClass('d-none');
                $('input[name="amount"]').val('');
            }
        })
    </script>
@endpush
