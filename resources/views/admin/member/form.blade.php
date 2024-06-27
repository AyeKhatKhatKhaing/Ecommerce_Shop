<div class="row">
    <div class="col-md-8">
        <h2 class="fs-1">@if($formMode == "edit") {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.member') }} </h2>
    </div>
    <div class="col-md-4 text-end">
        <div class="form-group">
            <div class="form-group">
                <div class="float-left">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                        {{ __('backend.common.save') }}</button>
                    <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('/admin/member') }}'"><i class="bi bi-x"
                            aria-hidden="true"></i> {{ __('backend.common.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header border-0">
                <div class="card-title">{{ __('backend.member.member_information') }}</div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('first_name') ? 'has-error' : ''}}">
                            {!! Form::label('first_name',  __('backend.member.first_name'), ['class' => 'control-label mb-3 required']) !!}
                            {!! Form::text('first_name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('first_name', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('last_name') ? 'has-error' : ''}}">
                            {!! Form::label('last_name', __('backend.member.last_name'), ['class' => 'control-label mb-3 required']) !!}
                            {!! Form::text('last_name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('last_name', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('phone') ? 'has-error' : ''}}">
                            {!! Form::label('phone', __('backend.member.phone'), ['class' => 'control-label mb-3 required']) !!}
                            {!! Form::text('phone', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('phone', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('email') ? 'has-error' : ''}}">
                            {!! Form::label('email', __('backend.member.email_address'), ['class' => 'control-label mb-3 required']) !!}
                            {!! Form::text('email', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('company') ? 'has-error' : ''}}">
                            {!! Form::label('company', __('backend.member.company_name'), ['class' => 'control-label mb-3']) !!}
                            {!! Form::text('company', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('company', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('account_type') ? 'has-error' : ''}}">
                            {!! Form::label('account_type', __('backend.member.account_type'), ['class' => 'control-label mb-3 required']) !!}
                            {!! Form::select('account_type', config('general.account_type'), null,  ['class' => 'form-select', 'data-control' => 'select2', 'data-hide-search' => "true", 'placeholder' => 'Select Account Type', 'data-placeholder' => __('backend.member.select_account_type')]) !!}
                            {!! $errors->first('account_type', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('company_website') ? 'has-error' : ''}}">
                            {!! Form::label('company_website', __('backend.member.company_website'), ['class' => 'control-label mb-3']) !!}
                            {!! Form::text('company_website', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('company_website', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('business_type') ? 'has-error' : ''}}">
                            {!! Form::label('business_type', __('backend.member.business_type'), ['class' => 'control-label mb-3']) !!}
                            {!! Form::select('business_type', $business_types, null,  ['class' => 'form-select', 'data-control' => 'select2', 'data-hide-search' => "true", 'placeholder' => 'Select Business Type', 'data-placeholder' => __('backend.member.select_business_type')]) !!}
                            {!! $errors->first('business_type', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('country_id') ? 'has-error' : ''}}">
                                    {!! Form::label('country_id', __('backend.member.country'), ['class' => 'control-label mb-3']) !!}
                                    {!! Form::select('country_id', $countries, null,  ['class' => 'form-select', 'data-control' => 'select2', 'data-hide-search' => "true", 'placeholder' => 'Select Country', 'data-placeholder' => __('backend.member.select_country')]) !!}
                                    {!! $errors->first('country_id', '<p class="text-danger">:message</p>') !!}
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group{{ $errors->has('region_id') ? 'has-error' : ''}}">
                                    {!! Form::label('region_id', __('backend.member.region'), ['class' => 'control-label mb-3']) !!}
                                    {!! Form::select('region_id', $regions, null,  ['class' => 'form-select', 'data-control' => 'select2', 'data-hide-search' => "true", 'placeholder' => 'Select Region', 'data-placeholder' => __('backend.member.select_region')]) !!}
                                    {!! $errors->first('region_id', '<p class="text-danger">:message</p>') !!}
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('postal_code') ? 'has-error' : ''}}">
                            {!! Form::label('postal_code', __('backend.member.postal_code'), ['class' => 'control-label mb-3']) !!}
                            {!! Form::text('postal_code', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('postal_code', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('dob') ? 'has-error' : ''}}">
                            {!! Form::label('dob', __('backend.member.dob'), ['class' => 'control-label mb-3']) !!}
                            {!! Form::date('dob', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('dob', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('city') ? 'has-error' : ''}}">
                            {!! Form::label('city', __('backend.member.town'), ['class' => 'control-label']) !!}
                            {!! Form::text('city', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('city', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('state') ? 'has-error' : ''}}">
                            {!! Form::label('state', __('backend.member.state'), ['class' => 'control-label']) !!}
                            {!! Form::text('state', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('state', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('address') ? 'has-error' : ''}}">
                            {!! Form::label('address', __('backend.member.street_address'), ['class' => 'control-label mb-3']) !!}
                            {!! Form::text('address', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('address', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
                            <div class="list-title mb-3">
                                {!! Form::label('password', __('backend.member.password'), ['class' => 'control-label required']) !!}
                            </div>
                            @php
                                $passwordOptions = ['class' => 'form-control'];
                                if ($formMode === 'create') {
                                    $passwordOptions = array_merge($passwordOptions, ['required' => 'required']);
                                }
                            @endphp
                            {!! Form::password('password', $passwordOptions) !!}
                            {!! $errors->first('password', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('created_date') ? 'has-error' : ''}}">
                            {!! Form::label('created_date', __('backend.member.registered_date'), ['class' => 'control-label mb-3']) !!}
                            {!! Form::input('datetime-local', 'created_date', isset($member) ? $member->created_date : now(), ('' == 'required') ? ['class' => 'form-control form-control-solid', 'required' => 'required', 'readonly' => true] : ['class' => 'form-control form-control-solid', 'readonly' => true]) !!}
                            {!! $errors->first('created_date', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                    @if($formMode == 'edit')
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('purchased_amount') ? 'has-error' : ''}}">
                                {!! Form::label('purchased_amount', __('backend.member.purchased_amount'), ['class' => 'control-label mb-3']) !!}
                                {!! Form::text('purchased_amount', isset($member)? $member->purchased_amount : '' , ('' == 'required') ? ['class' => 'form-control form-control-solid', 'required' => 'required', 'readonly' => true] : ['class' => 'form-control form-control-solid', 'readonly' => true]) !!}
                                {!! $errors->first('purchased_amount', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    {!! Form::label('member_type_id', __('backend.member.member_type'), ['class' => 'control-label']) !!}
                </div>
            </div>
            <div class="card-body">
                <div class="form-group{{ $errors->has('member_type_id') ? 'has-error' : ''}}">
                    <div class="overflow">
                        @foreach ($member_types as $member_type)
                        <div class="form-check mb-5">
                            <input class="form-check-input" class="member_type_input" name="member_type_id" type="radio" value="{{ $member_type->id}}" {{ isset($member) ? (($member_type->id == $member->member_type_id) ? 'checked' : '') : '' }} />
                            {{ $member_type->name_en }}
                        </div>
                        @endforeach
                    </div>
                    {!! $errors->first('member_type_id', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>
</div>
