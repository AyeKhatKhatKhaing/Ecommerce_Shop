<div class="row">
    <div class="col-md-8">
        <h2 class="fs-1">@if($formMode == "edit") {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.footer') }}</h2>
    </div>
    <div class="col-md-4 text-end">
        <div class="form-group">
            <div class="form-group">
                <div class="float-left">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                        {{ __('backend.common.save') }}</button>
                    <button type="button" class="btn btn-secondary cancel" onclick="window.history.back()"><i class="bi bi-x"
                            aria-hidden="true"></i> {{ __('backend.common.cancel') }}</button>
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
                                    <div class="form-group{{ $errors->has('mobile_content_'.$lng) ? 'has-error' : ''}}">
                                        @foreach (config('locale.langs_code') as $key => $code)
                                            @if ($lng == $key)
                                                {!! Form::label('mobile_content_'.$lng, __('backend.footer.mobile_content').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                            @endif
                                        @endforeach
                                        {!! Form::textarea('mobile_content_'.$lng, isset($footer) && isset($footer->mobile_contents) ? $footer->mobile_contents[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                        {!! $errors->first('mobile_content_'.$lng, '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <div class="form-group{{ $errors->has('web_content_'.$lng) ? 'has-error' : ''}}">
                                        @foreach (config('locale.langs_code') as $key => $code)
                                            @if ($lng == $key)
                                                {!! Form::label('web_content_'.$lng, __('backend.footer.web_content').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                            @endif
                                        @endforeach
                                        {!! Form::textarea('web_content_'.$lng, isset($footer) && isset($footer->web_contents) ? $footer->web_contents[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                        {!! $errors->first('web_content_'.$lng, '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('instagram_link') ? 'has-error' : ''}}">
                                {!! Form::label('instagram_link', __('backend.footer.instagram_link'), ['class' => 'control-label mb-3']) !!}
                                {!! Form::text('instagram_link', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                {!! $errors->first('instagram_link', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('facebook_link') ? 'has-error' : ''}}">
                                {!! Form::label('facebook_link', __('backend.footer.facebook_link'), ['class' => 'control-label mb-3']) !!}
                                {!! Form::text('facebook_link', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                {!! $errors->first('facebook_link', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
