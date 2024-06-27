<div class="row">
    <div class="col-md-8">
        <h2 class="fs-1">@if($formMode == "edit")  {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.member_type') }} </h2>
    </div>
    <div class="col-md-4 text-end">
        <div class="form-group">
            <div class="form-group">
                <div class="float-left">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                        {{ __('backend.common.save') }}</button>
                    <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('admin/member-type') }}'"><i class="bi bi-x" aria-hidden="true"></i> {{ __('backend.common.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-12">
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
                                                {!! Form::label('name_'.$lng, __('backend.member_type.name').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
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
                                                {!! Form::label('description_'.$lng, __('backend.member_type.description').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                            @endif
                                        @endforeach
                                        {!! Form::textarea('description_'.$lng, isset($membertype) && isset($membertype->descriptions) ? $membertype->descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                        {!! $errors->first('description_'.$lng, '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="mb-3 form-group{{ $errors->has('min_purchase_amount') ? 'has-error' : ''}}">
                                <div class="list-title mb-3">
                                    {!! Form::label('min_purchase_amount',  __('backend.member_type.minimum_amount'), ['class' => 'control-label required']) !!}
                                </div>
                                <div class="from-group mb-3">
                                    <div class="input-group mb-3">
                                        <div class="w-100 mw-150px">
                                            {!! Form::select('currency_type', config('general.currency_type'), null, ['class' => 'form-select form-select-solid', 'data-control' => 'select2', 'data-hide-search' => "true", 'data-placeholder' => "Select Payment Method"]) !!}
                                        </div>
                                        {!! Form::number('min_purchase_amount', null, ('' == 'required') ? ['class' => 'form-control w-100', 'required' => 'required', 'step' => 'any'] : ['class' => 'form-control', 'step' => 'any']) !!}
                                    </div>
                                </div>
                                {!! $errors->first('min_purchase_amount', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>