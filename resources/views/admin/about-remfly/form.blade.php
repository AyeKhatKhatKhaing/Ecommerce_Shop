<div class="row">
    <div class="col-md-8">
        <h2 class="fs-1">@if($formMode == "edit") {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.about_remfly') }}</h2>
    </div>
    <div class="col-md-4 text-end">
        <div class="form-group">
            <div class="form-group">
                <div class="float-left">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                        {{ __('backend.common.save') }}</button>
                    <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('/admin/about-remfly') }}'"><i class="bi bi-x"
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
                        <div class="form-group {{ $errors->has('banner_title'.$lng) ? 'has-error' : ''}}">
                            @foreach (config('locale.langs_code') as $key => $code)
                                @if ($lng == $key)
                                    {!! Form::label('banner_title_'.$lng, __('backend.about_remfly.banner_title').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                @endif
                            @endforeach
                            {!! Form::text('banner_title_'.$lng, isset($aboutremfly) && isset($aboutremfly->banner_titles) ? $aboutremfly->banner_titles[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                            {!! $errors->first('banner_title_'.$lng, '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="form-group mt-4{{ $errors->has('description_'.$lng) ? 'has-error' : ''}}">
                            @foreach (config('locale.langs_code') as $key => $code)
                                @if ($lng == $key)
                                    {!! Form::label('description_'.$lng, __('backend.about_remfly.description').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                @endif
                            @endforeach
                            {!! Form::textarea('description_'.$lng, isset($aboutremfly) && isset($aboutremfly->description) ? $aboutremfly->description[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                            {!! $errors->first('description_'.$lng, '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="form-group mt-4{{ $errors->has('key_operation_'.$lng) ? 'has-error' : ''}}">
                            @foreach (config('locale.langs_code') as $key => $code)
                                @if ($lng == $key)
                                    {!! Form::label('key_operation_'.$lng, __('backend.about_remfly.key_operation').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                @endif
                            @endforeach
                            {!! Form::textarea('key_operation_'.$lng, isset($aboutremfly) && isset($aboutremfly->key_operation) ? $aboutremfly->key_operation[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                            {!! $errors->first('key_operation_'.$lng, '<p class="help-block">:message</p>') !!}
                        </div>
                    
                        <div class="card mt-5">
                            <div class="card-header border-0 ps-0">
                                <div class="card-title">{{ __('backend.seo.search_engine_optimize') }}</div>
                            </div>
                            <div class="card-body ps-0 pe-0">
                                <div class="row">
                                    <div class="@if ($lng == 'en') col-md-6 @else col-md-12 @endif">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group{{ $errors->has('meta_title_'.$lng) ? 'has-error' : ''}}">
                                                    @foreach (config('locale.langs_code') as $key => $code)
                                                        @if ($lng == $key)
                                                            {!! Form::label('meta_title_'.$lng, __('backend.seo.meta_title').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                                        @endif
                                                    @endforeach
                                                    {!! Form::text('meta_title_'.$lng, isset($aboutremfly) && isset($aboutremfly->meta_titles) ? $aboutremfly->meta_titles[$lng] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                    {!! $errors->first('meta_title_'.$lng, '<p class="help-block">:message</p>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="form-group{{ $errors->has('meta_description_'.$lng) ? 'has-error' : ''}}">
                                                    @foreach (config('locale.langs_code') as $key => $code)
                                                        @if ($lng == $key)
                                                            {!! Form::label('meta_description_'.$lng, __('backend.seo.meta_description').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                                        @endif
                                                    @endforeach
                                                    {!! Form::textarea('meta_description_'.$lng, isset($aboutremfly) && isset($aboutremfly->meta_descriptions) ? $aboutremfly->meta_descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control h-150px', 'required' => 'required'] : ['class' => 'form-control h-150px']) !!}
                                                    {!! $errors->first('meta_description_'.$lng, '<p class="help-block">:message</p>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($lng == 'en')
                                        <div class="col-md-6">
                                            <div class="card-body pt-0">
                                                <div class="list-title mb-3">
                                                    <label for="kt_ecommerce_add_product_store_template" class="form-label">
                                                        <span style="color: #B5B5C3">{{ __('backend.common.image_size') }}(1200 x 630)px</span>
                                                    </label>
                                                </div>
                                                <div class="panel-block">
                                                    <div class="form-group">
                                                    <div id="holder-meta-image">
                                                            @if(!empty($aboutremfly->meta_image))
                                                                <div class='lfmimage-container meta-imagelfmc0'>
                                                                    <img src="{{ asset($aboutremfly->meta_image) }}" class='lfmimage w-100' style="height: 20rem;">
                                                                    <div>
                                                                        <button type="button" onclick="removeImage('meta-image',0)" class="btn btn-icon btn-active-light-danger btn btn-danger w-40px h-40px remove-image w-100" style="position: absolute; top: 150px; right: 50px;">
                                                                            <i class='bi bi-trash'></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <img src="{{ asset('backend/media/blank-image.svg') }}" class="img-thumbnail">
                                                            @endif
                                                    </div>
                                                    <div class="input-group mt-3">
                                                        <span class="input-group-btn">
                                                            <a id="lfm-meta-image" data-input="meta-image" data-preview="holder-meta-image" class="btn btn-primary text-white">
                                                                <i class="bi bi-image-fill"></i>{{ __('backend.common.choose') }}
                                                            </a>
                                                        </span>
                                                        <input id="meta-image" class="form-control" type="text" name="meta_image" value="{{isset($aboutremfly) ? $aboutremfly->meta_image : ''}}">
                                                    </div>  
                                                    {!! $errors->first('meta_image', '<p class="help-block">:message</p>') !!}
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        {!! Form::label('meta_image_alt', 'Meta Image Alt', ['class' => 'control-label mb-3']) !!}
                                                        {!! Form::text('meta_image_alt', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                        {!! $errors->first('meta_image_alt', '<p class="help-block">:message</p>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('backend.about_remfly.banner_image') }}</h3>
            </div>
            <div class="card-body">
                <div class="list-title mb-3">
                    <label for="kt_ecommerce_add_product_store_template" class="form-label">
                        <span style="color: #B5B5C3">{{ __('backend.common.image_size') }}( 371 x 218 )px</span>
                    </label>
                </div>
                <div class="panel-block">
                    <div class="form-group">
                        <div id="holder-banner-image">
                            @if(!empty($aboutremfly->banner_image))
                                <div class='lfmimage-container banner-imagelfmc0'>
                                    <img src="{{ asset($aboutremfly->banner_image) }}" class='lfmimage w-100' style="height: 20rem;">
                                    <button type="button" onclick="removeImage('banner-image',0)" class="btn btn-icon btn-active-light-danger btn btn-danger w-40px h-40px remove-image w-100" style="position: absolute; top: 150px; right: 50px;">
                                        <i class='bi bi-trash'></i>
                                    </button>
                                </div>
                            @else
                                <img src="{{ asset('backend/media/remfly/images/blank-image.svg') }}" class="img-thumbnail">
                            @endif
                        </div>
                        <div class="input-group mt-3">
                            <span class="input-group-btn">
                                <a id="lfm-banner-image" data-input="banner-image" data-preview="holder-banner-image" class="btn btn-primary text-white">
                                    <i class="bi bi-image-fill"></i>{{ __('backend.common.choose') }}
                                </a>
                            </span>
                            <input id="banner-image" class="form-control" type="text" name="banner_image" value="{{isset($aboutremfly->banner_image) ? $aboutremfly->banner_image : ''}}">
                        </div> 
                            {!! $errors->first('banner_image', '<p class="help-block">:message</p>') !!} 
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        {!! Form::label('banner_image_alt', 'Banner Image Alt', ['class' => 'control-label mb-3']) !!}
                        {!! Form::text('banner_image_alt', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                        {!! $errors->first('banner_image_alt', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $('#lfm-banner-image').filemanager('file');
    $('#lfm-meta-image').filemanager('file');
</script>
@endpush
