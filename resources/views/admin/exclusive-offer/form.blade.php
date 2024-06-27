<div class="row">
    <div class="col-md-8">
        <h2 class="fs-1">@if($formMode == "edit") {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.exclusive_offer') }}</h2>
    </div>
    <div class="col-md-4 text-end">
        <div class="form-group">
            <div class="form-group">
                <div class="float-left">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                        {{ __('backend.common.save') }}</button>
                    <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('admin/exclusive-offer') }}'"><i class="bi bi-x"
                            aria-hidden="true"></i> {{ __('backend.common.cancel') }}</button>
                </div>
            </div>
        </div>
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
                        <div class="form-group{{ $errors->has('title_'.$lng) ? 'has-error' : ''}}">
                            @foreach (config('locale.langs_code') as $key => $code)
                                @if ($lng == $key)
                                    {!! Form::label('title_'.$lng, __('backend.exclusive_offer.title').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                @endif
                            @endforeach
                            {!! Form::text('title_'.$lng, isset($exclusiveoffer) && isset($exclusiveoffer->titles) ? $exclusiveoffer->titles[$lng] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('title_'.$lng, '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('description_'.$lng) ? 'has-error' : ''}}">
                                    @foreach (config('locale.langs_code') as $key => $code)
                                        @if ($lng == $key)
                                            {!! Form::label('description_'.$lng, __('backend.exclusive_offer.description').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                        @endif
                                    @endforeach
                                    {!! Form::text('description_'.$lng, isset($exclusiveoffer) && isset($exclusiveoffer->descriptions) ? $exclusiveoffer->descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                    {!! $errors->first('description_'.$lng, '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('link') ? 'has-error' : ''}}">
                                {!! Form::label('link', __('backend.exclusive_offer.link'), ['class' => 'control-label mb-3']) !!}
                                {!! Form::text('link', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('backend.common.image') }}</h3>
            </div>
            <div class="card-body">
                <div class="list-title mb-3">
                    <label for="kt_ecommerce_add_product_store_template" class="form-label">
                        <span style="color: #B5B5C3">{{ __('backend.common.image_size') }}( 371 x 218 )px</span>
                    </label>
                </div>
                <div class="panel-block">
                    <div class="form-group">
                       <div id="holder-image">
                            @if(!empty($exclusiveoffer->image))
                                <div class='lfmimage-container imagelfmc0'>
                                    <img src="{{ asset($exclusiveoffer->image) }}" class='lfmimage w-100' style="height: 20rem;">
                                    <div>
                                        <button type="button" onclick="removeImage('image',0)" class="btn btn-icon btn-active-light-danger btn btn-danger w-40px h-40px remove-image w-100" style="position: absolute; top: 150px; right: 50px;">
                                            <i class='bi bi-trash'></i>
                                        </button>
                                    </div>
                                </div>
                            @else
                                <img src="{{ asset('backend/media/remfly/images/blank-image.svg') }}" class="img-thumbnail">
                            @endif
                       </div>
                       <div class="input-group mt-3">
                            <span class="input-group-btn">
                                <a id="lfm-image" data-input="exclusive-image" data-preview="holder-image" class="btn btn-primary text-white">
                                    <i class="bi bi-image-fill"></i>{{ __('backend.common.choose') }}
                                </a>
                            </span>
                            <input id="exclusive-image" class="form-control" type="text" name="image" value="{{isset($exclusiveoffer) ? $exclusiveoffer->image : ''}}">
                       </div>  
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        {!! Form::label('image_alt', 'Image Alt', ['class' => 'control-label mb-3']) !!}
                        {!! Form::text('image_alt', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                        {!! $errors->first('image_alt', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <div class="card-title">
                    {{ __('backend.exclusive_offer.sort') }}
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('sort') ? 'has-error' : ''}}">
                            {!! Form::number('sort', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('sort', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('#lfm-image').filemanager('file');
    </script>
@endpush