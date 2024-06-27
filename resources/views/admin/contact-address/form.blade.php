<div class="row">
    <div class="col-md-8">
        <h2 class="fs-1">@if($formMode == "edit")  {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.contact_address') }}</h2>
    </div>
    <div class="col-md-4 text-end">
        <div class="form-group">
            <div class="form-group">
                <div class="float-left">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                        {{ __('backend.common.edit') }}</button>
                    <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('/admin/contact-address') }}'"><i class="bi bi-x"
                            aria-hidden="true"></i> {{ __('backend.common.edit') }}</button>
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
                                            {!! Form::label('name_'.$lng,  __('backend.contact_address.name').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                        @endif
                                    @endforeach
                                    {!! Form::text('name_'.$lng, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                    {!! $errors->first('name_'.$lng, '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('address_'.$lng) ? 'has-error' : ''}}">
                                    @foreach (config('locale.langs_code') as $key => $code)
                                        @if ($lng == $key)
                                            {!! Form::label('address_'.$lng, __('backend.contact_address.address').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                        @endif
                                    @endforeach
                                    {!! Form::textarea('address_'.$lng, null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                    {!! $errors->first('address_'.$lng, '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('google_map') ? 'has-error' : ''}}">
                                {!! Form::label('google_map', __('backend.contact_address.google_map'), ['class' => 'control-label mb-3']) !!}
                                {!! Form::textarea('google_map', null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                {!! $errors->first('google_map', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
