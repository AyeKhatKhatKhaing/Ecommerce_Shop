<div class="row">
    <div class="col-md-8">
        <h2 class="fs-1">@if($formMode == "edit") {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.site_setting') }} </h2>
    </div>
    <div class="col-md-4 text-end">
        <div class="form-group">
            <div class="form-group">
                <div class="float-left">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                        {{ __('backend.common.save') }}</button>
                    <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('/admin/site-setting') }}'"><i class="bi bi-x"
                            aria-hidden="true"></i> {{ __('backend.common.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card ps-0 pe-0" style="border: 1px solid #E4E6EF">
            <div class="card-header" style="min-height: 0px;padding:0px;">
                <ul class="nav nav-pills nav-fill">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#basic_information" style="border-radius: 10px 10px 1px 1px; padding: 10px 15px 10px 15px;">{{ __('backend.site_setting.basic_information') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#currency" style="border-radius: 10px 10px 1px 1px; padding: 10px 15px 10px 15px;">{{ __('backend.site_setting.currency') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#contact_information" style="border-radius: 10px 10px 1px 1px; padding: 10px 15px 10px 15px;">{{ __('backend.site_setting.contact_information') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#register" style="border-radius: 10px 10px 1px 1px; padding: 10px 15px 10px 15px;">{{ __('backend.site_setting.register') }}</a>
                    </li>
                </ul>
            </div>
            @if(isset($site_setting) && count($site_setting) > 0)
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="basic_information" role="tabpanel">
                            <input type="hidden" name="types[]" value="basic">
                            <div class="card border">
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
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <div class="form-group{{ $errors->has($lng.'_law') ? 'has-error' : ''}}">
                                                            {!! Form::label($lng.'_law', __('backend.site_setting.law'), ['class' => 'control-label mb-3']) !!}
                                                            {!! Form::text($lng.'_law', isset($site_setting) && isset($site_setting[0]) && isset($site_setting[0]->options) ? $site_setting[0]->options[$lng.'_law'] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                            {!! $errors->first($lng.'_law', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="form-group{{ $errors->has('hk_whatsapp') ? 'has-error' : ''}}">
                                                    {!! Form::label('hk_whatsapp', __('backend.site_setting.hk_whatsapp'), ['class' => 'control-label mb-3']) !!}
                                                    {!! Form::text('hk_whatsapp', isset($site_setting) && isset($site_setting[0]) && isset($site_setting[0]->options) ? $site_setting[0]->options['hk_whatsapp'] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                    {!! $errors->first('hk_whatsapp', '<p class="help-block">:message</p>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="form-group{{ $errors->has('ma_whatsapp') ? 'has-error' : ''}}">
                                                    {!! Form::label('ma_whatsapp', __('backend.site_setting.ma_whatsapp'), ['class' => 'control-label mb-3']) !!}
                                                    {!! Form::text('ma_whatsapp', isset($site_setting) && isset($site_setting[0]) && isset($site_setting[0]->options) ? $site_setting[0]->options['ma_whatsapp'] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                    {!! $errors->first('ma_whatsapp', '<p class="help-block">:message</p>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="currency" role="tabpanel">
                            <input type="hidden" name="types[]" value="currency">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('hk_rate') ? 'has-error' : ''}}">
                                        {!! Form::label('hk_rate',  __('backend.site_setting.hk_currency'), ['class' => 'control-label mb-3']) !!}
                                        {!! Form::text('hk_rate', isset($site_setting) && isset($site_setting[1]) && isset($site_setting[1]->options) ? $site_setting[1]->options['hk_rate'] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('hk_rate', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('ma_rate') ? 'has-error' : ''}}">
                                        {!! Form::label('ma_rate', __('backend.site_setting.ma_currency'), ['class' => 'control-label mb-3']) !!}
                                        {!! Form::text('ma_rate', isset($site_setting) && isset($site_setting[1]) && isset($site_setting[1]->options) ? $site_setting[1]->options['ma_rate'] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('ma_rate', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact_information" role="tabpanel">
                            <input type="hidden" name="types[]" value="contact">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('contact_email') ? 'has-error' : ''}}">
                                        {!! Form::label('contact_email', __('backend.site_setting.contact_email_address'), ['class' => 'control-label mb-3']) !!}
                                        {!! Form::text('contact_email', isset($site_setting) && isset($site_setting[2]) && isset($site_setting[2]->options) ? $site_setting[2]->options['contact_email'] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('contact_email', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('hk_phone') ? 'has-error' : ''}}">
                                        {!! Form::label('hk_phone', __('backend.site_setting.hk_phone'), ['class' => 'control-label mb-3']) !!}
                                        {!! Form::text('hk_phone', isset($site_setting) && isset($site_setting[2]) && isset($site_setting[2]->options) ? $site_setting[2]->options['hk_phone'] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('hk_phone', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('hk_email') ? 'has-error' : ''}}">
                                        {!! Form::label('hk_email', __('backend.site_setting.hk_email'), ['class' => 'control-label mb-3']) !!}
                                        {!! Form::text('hk_email', isset($site_setting) && isset($site_setting[2]) && isset($site_setting[2]->options) ? $site_setting[2]->options['hk_email'] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('hk_email', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('ma_phone') ? 'has-error' : ''}}">
                                        {!! Form::label('ma_phone', __('backend.site_setting.ma_phone'), ['class' => 'control-label mb-3']) !!}
                                        {!! Form::text('ma_phone', isset($site_setting) && isset($site_setting[2]) && isset($site_setting[2]->options) ? $site_setting[2]->options['ma_phone'] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('ma_phone', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('ma_email') ? 'has-error' : ''}}">
                                        {!! Form::label('ma_email', __('backend.site_setting.ma_email'), ['class' => 'control-label mb-3']) !!}
                                        {!! Form::text('ma_email', isset($site_setting) && isset($site_setting[2]) && isset($site_setting[2]->options) ? $site_setting[2]->options['ma_email'] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('ma_email', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="register" role="tabpanel">
                            <input type="hidden" name="types[]" value="register">
                            <div class="card border">
                                <div class="card-header" style="min-height: 0px;padding:0px;">
                                    <ul class="nav nav-pills nav-fill">
                                        @foreach (config('locale.langs') as $lngcode => $lng)
                                            <li class="nav-item">
                                                <a class="nav-link {{ $lngcode == 'en' ? 'active' : '' }} nav_link" data-bs-toggle="tab" href="#{{ strtolower($lngcode) }}-register-tab" style="border-radius: 7px 7px 1px 1px;">
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
                                            <div class="tab-pane fade {{ $lng == 'en' ? 'active show' : '' }}"  id="{{ strtolower($lng) }}-register-tab">    
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <div class="form-group{{ $errors->has($lng.'_privacy') ? 'has-error' : ''}}">
                                                            {!! Form::label($lng.'_privacy', __('backend.site_setting.register'), ['class' => 'control-label mb-3']) !!}
                                                            {!! Form::textarea($lng.'_privacy', isset($site_setting) && isset($site_setting[3]) && isset($site_setting[3]->options) ? $site_setting[3]->options[$lng.'_privacy'] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                                            {!! $errors->first($lng.'_privacy', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <div class="form-group{{ $errors->has($lng.'_register_law') ? 'has-error' : ''}}">
                                                            {!! Form::label($lng.'_register_law', __('backend.site_setting.law'), ['class' => 'control-label mb-3']) !!}
                                                            {!! Form::text($lng.'_register_law', isset($site_setting) && isset($site_setting[3]) && isset($site_setting[3]->options) ? $site_setting[3]->options[$lng.'_register_law'] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                            {!! $errors->first($lng.'_register_law', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="basic_information" role="tabpanel">
                            <input type="hidden" name="types[]" value="basic">
                            <div class="card border">
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
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <div class="form-group{{ $errors->has($lng.'_law') ? 'has-error' : ''}}">
                                                            {!! Form::label($lng.'_law', __('backend.site_setting.law'), ['class' => 'control-label mb-3']) !!}
                                                            {!! Form::text($lng.'_law', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                            {!! $errors->first($lng.'_law', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="form-group{{ $errors->has('hk_whatsapp') ? 'has-error' : ''}}">
                                                    {!! Form::label('hk_whatsapp', __('backend.site_setting.hk_whatsapp'), ['class' => 'control-label mb-3']) !!}
                                                    {!! Form::text('hk_whatsapp', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                    {!! $errors->first('hk_whatsapp', '<p class="help-block">:message</p>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="form-group{{ $errors->has('ma_whatsapp') ? 'has-error' : ''}}">
                                                    {!! Form::label('ma_whatsapp', __('backend.site_setting.ma_whatsapp'), ['class' => 'control-label mb-3']) !!}
                                                    {!! Form::text('ma_whatsapp', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                    {!! $errors->first('ma_whatsapp', '<p class="help-block">:message</p>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="currency" role="tabpanel">
                            <input type="hidden" name="types[]" value="currency">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('hk_rate') ? 'has-error' : ''}}">
                                        {!! Form::label('hk_rate', __('backend.site_setting.hk_currency'), ['class' => 'control-label mb-3']) !!}
                                        {!! Form::text('hk_rate', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('hk_rate', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('ma_rate') ? 'has-error' : ''}}">
                                        {!! Form::label('ma_rate', __('backend.site_setting.ma_currency'), ['class' => 'control-label mb-3']) !!}
                                        {!! Form::text('ma_rate', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('ma_rate', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact_information" role="tabpanel">
                            <input type="hidden" name="types[]" value="contact">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('contact_email') ? 'has-error' : ''}}">
                                        {!! Form::label('contact_email', __('backend.site_setting.contact_email_address'), ['class' => 'control-label mb-3']) !!}
                                        {!! Form::text('contact_email', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('contact_email', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('hk_phone') ? 'has-error' : ''}}">
                                        {!! Form::label('hk_phone', __('backend.site_setting.hk_phone'), ['class' => 'control-label mb-3']) !!}
                                        {!! Form::text('hk_phone', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('hk_phone', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('hk_email') ? 'has-error' : ''}}">
                                        {!! Form::label('hk_email', __('backend.site_setting.hk_email'), ['class' => 'control-label mb-3']) !!}
                                        {!! Form::text('hk_email', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('hk_email', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('ma_phone') ? 'has-error' : ''}}">
                                        {!! Form::label('ma_phone', __('backend.site_setting.ma_phone'), ['class' => 'control-label mb-3']) !!}
                                        {!! Form::text('ma_phone', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('ma_phone', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('ma_email') ? 'has-error' : ''}}">
                                        {!! Form::label('ma_email', __('backend.site_setting.ma_email'), ['class' => 'control-label mb-3']) !!}
                                        {!! Form::text('ma_email', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('ma_email', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="basic_information" role="tabpanel">
                            <input type="hidden" name="types[]" value="basic">
                            <div class="card border">
                                <div class="card-header" style="min-height: 0px;padding:0px;">
                                    <ul class="nav nav-pills nav-fill">
                                        @foreach (config('locale.langs') as $lngcode => $lng)
                                            <li class="nav-item">
                                                <a class="nav-link {{ $lngcode == 'en' ? 'active' : '' }} nav_link" data-bs-toggle="tab" href="#{{ strtolower($lngcode) }}-register-tab" style="border-radius: 7px 7px 1px 1px;">
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
                                            <div class="tab-pane fade {{ $lng == 'en' ? 'active show' : '' }}"  id="{{ strtolower($lng) }}-register-tab">    
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <div class="form-group{{ $errors->has($lng.'_privacy') ? 'has-error' : ''}}">
                                                            {!! Form::label($lng.'_privacy', __('backend.site_setting.register'), ['class' => 'control-label mb-3']) !!}
                                                            {!! Form::text($lng.'_privacy', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                            {!! $errors->first($lng.'_privacy', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <div class="form-group{{ $errors->has($lng.'_register_law') ? 'has-error' : ''}}">
                                                            {!! Form::label($lng.'_register_law', __('backend.site_setting.law'), ['class' => 'control-label mb-3']) !!}
                                                            {!! Form::text($lng.'_register_law', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                            {!! $errors->first($lng.'_register_law', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@push('scripts')
<script>
    
</script>
@endpush
