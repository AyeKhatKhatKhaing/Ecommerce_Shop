<div class="row">
    <div class="col-md-12">
        <h2 class="fs-1">@if($formMode == "edit") {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.coupon') }} </h2>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="list-title mb-3">
                                {!! Form::label('code', __('backend.coupon.code'), ['class' => 'control-label required']) !!}
                            </div>
                            <div class="input-group mb-5">
                                {!! Form::text('code', null, ('' == 'required') ? ['class' => 'form-control code-generate', 'required' => 'required'] : ['class' => 'form-control code-generate']) !!}
                                <button type="button" class="input-group-text btn btn-info generate" style="border-radius: 5px;">{{ __('backend.coupon.generate_code') }}</button>
                                {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('coupon_type') ? 'has-error' : ''}}">
                                {!! Form::label('coupon_type', __('backend.coupon.coupon_type'), ['class' => 'control-label mb-3']) !!}
                                <select class="form-select {{ isset($coupon) && isset($coupon->coupon_type) ? 'form-select-solid' : '' }}" data-control="select2" data-hide-search="true" data-placeholder="{{  __('backend.coupon.select_coupon_type') }}" id="coupon_type" name="coupon_type" data-select2-id="select2-data-coupon_type" tabindex="-1" aria-hidden="true" {{ isset($coupon) && isset($coupon->coupon_type) ? 'disabled' : '' }}>
                                    <option></option>
                                    @foreach (config('general.coupon_type') as $coupon_value => $value)
                                        <option value="{{ $coupon_value }}" {{ isset($coupon) && $coupon->coupon_type == $coupon_value ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('coupon_type', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 {{ isset($coupon) && isset($coupon->products) ? '' : 'd-none' }}" id="product-row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('products') ? 'has-error' : ''}} disabled">
                                {!! Form::label('products', __('backend.sidebar.products'), ['class' => 'control-label mb-3']) !!}
                                {!! Form::select('products[]', $products, null, ['class' => 'form-select form-select-lg form-select', 'data-control' => 'select2', 'data-placeholder' => __('backend.coupon.select_products'), 'data-allow-clear' => 'true' , 'multiple' => 'multiple']) !!}
                                {!! $errors->first('products', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 {{ isset($coupon) && isset($coupon->member_type_id) ? '' : 'd-none' }}" id="member-type-row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('member_type_id') ? 'has-error' : ''}}">
                                {!! Form::label('member_type_id', __('backend.sidebar.member_type'), ['class' => 'control-label mb-3']) !!}
                                {!! Form::select('member_type_id', $member_types, null, ['class' => 'form-select', 'data-control' => 'select2', 'data-hide-search' => "true", 'placeholder' => 'Select Member Type', 'data-placeholder' => __('backend.coupon.select_member_type')]) !!}
                                {!! $errors->first('member_type_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    @foreach (config('locale.langs') as $lng => $attr)
                        <div class="tab-pane fade {{ $lng == 'en' ? 'active show' : '' }}"  id="{{ strtolower($lng) }}-tab">     
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('description_'.$lng) ? 'has-error' : ''}}">
                                        @foreach (config('locale.langs_code') as $key => $code)
                                            @if ($lng == $key)
                                                {!! Form::label('description'.$lng, __('backend.coupon.description').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                            @endif
                                        @endforeach
                                        {!! Form::textarea('description_'.$lng, isset($coupon) && isset($coupon->descriptions[$lng]) ? $coupon->descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'rows' => 2] : ['class' => 'form-control', 'rows' => 2]) !!}
                                        {!! $errors->first('description_'.$lng, '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div> 
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header border-0">
                <div class="card-title">
                    {{ __('backend.coupon.discount_type') }}
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('discount_type') ? 'has-error' : ''}}">
                            {!! Form::label('type', __('backend.coupon.type'), ['class' => 'control-label mb-3']) !!}
                            {!! Form::select('discount_type', config('general.discount_type'), null, ['class' => 'form-select', 'data-control' => 'select2', 'data-hide-search' => "true", 'placeholder' => 'Select Discount Type', 'data-placeholder' => __('backend.coupon.select_discount_type')]) !!}
                            {!! $errors->first('discount_type', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="amount-type form-group{{ $errors->has('amount') ? 'has-error' : ''}} {{ isset($coupon) && isset($coupon->amount) ? '' : 'd-none' }}">
                            {!! Form::label('amount', __('backend.coupon.amount'), ['class' => 'control-label mb-3']) !!}
                            {!! Form::number('amount', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="percent-type form-group{{ $errors->has('percent') ? 'has-error' : ''}} {{ isset($coupon) && isset($coupon->percent) ? '' : 'd-none' }}">
                            {!! Form::label('percent', __('backend.coupon.percent'), ['class' => 'control-label mb-3']) !!}
                            {!! Form::number('percent', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('percent', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('start_date') ? 'has-error' : ''}}">
                            {!! Form::label('start_date', __('backend.coupon.start_date'), ['class' => 'control-label mb-3']) !!}
                            {!! Form::input('datetime-local', 'start_date', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('expiry_date') ? 'has-error' : ''}}">
                            {!! Form::label('expiry_date', __('backend.coupon.expiry_date'), ['class' => 'control-label mb-3']) !!}
                            {!! Form::input('datetime-local', 'expiry_date', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('expiry_date', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header border-0">
                <div class="card-title">
                    {{ __('backend.coupon.usage_tag') }}
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('per_coupon') ? 'has-error' : ''}}">
                            {!! Form::label('per_coupon', __('backend.coupon.per_coupon'), ['class' => 'control-label mb-3']) !!}
                            {!! Form::number('per_coupon', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('per_coupon', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('per_user') ? 'has-error' : ''}}">
                            {!! Form::label('per_user', __('backend.coupon.per_user'), ['class' => 'control-label mb-3']) !!}
                            {!! Form::number('per_user', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('per_user', '<p class="help-block">:message</p>') !!}
                        </div>
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
                    <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('/admin/coupon') }}'"><i class="bi bi-x"
                            aria-hidden="true"></i> {{ __('backend.common.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('document').ready(function(){
            $(document).on('click', '.generate', function(){
                var code = '';
                var str='ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                +  'abcdefghijklmnopqrstuvwxyz0123456789';

            for (let i = 1; i <= 8; i++) { 
                var char = Math.floor(Math.random()* str.length + 1); 
                        code += str.charAt(char) 
                    } 
            $('.code-generate').val(code);
            })
        })
    </script>
    <script>
        var type_name  =  $('#coupon_type').val();

        if (name == 'tier') {
            $('#member-type-row').removeClass('d-none');
            $('select[name="products[]"]').val('');
        }

        if (type_name == 'product') {
            $('#product-row').removeClass('d-none');
            $('select[name="member_type_id"]').val('');
        }

        $('#coupon_type').on('change', function() {
            var type = $(this).val();

            $('#product-row').addClass('d-none');
            $('#member-type-row').addClass('d-none');

            if (type == "tier") {
                $('#member-type-row').removeClass('d-none');
                $('select[name="products[]"]').val('');
            }

            if (type == "product") {
                $('#product-row').removeClass('d-none');
                $('select[name="member_type_id"]').val('');
            }
        })
    </script>
    <script>
        $('select[name="discount_type"]').on('select2:select', function () {
            var type  = $(this).val();

            $('.amount-type').addClass('d-none');
            $('.percent-type').addClass('d-none');

            if (type == "amount") {
                $('.amount-type').removeClass('d-none');
                $('input[name="percent"]').val('');
            }

            if (type == "percentage") {
                $('.percent-type').removeClass('d-none');
                $('input[name="amount"]').val('');
            }
        })
    </script>
@endpush