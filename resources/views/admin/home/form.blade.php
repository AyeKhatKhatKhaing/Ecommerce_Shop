<div class="row">
    <div class="col-md-8">
        <h2 class="fs-1">@if($formMode == "edit") {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.home') }}</h2>
    </div>
    <div class="col-md-4 text-end">
        <div class="form-group">
            <div class="form-group">
                <div class="float-left">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                        {{ __('backend.common.save') }}</button>
                    <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('/admin/home') }}'"><i class="bi bi-x"
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
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="accordion" id="featured">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="featured">
                                            <button class="accordion-button fs-6 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#remfly_feature" aria-expanded="true" aria-controls="remfly_feature" style="padding: 1.1rem 1rem;">
                                                {{ __('backend.home.remfly_featured') }}
                                            </button>
                                        </h2>
                                        <div id="remfly_feature" class="accordion-collapse collapse" aria-labelledby="featured" data-bs-parent="#featured">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="@if ($lng == 'en') col-md-8 @else col-md-12 @endif">
                                                        <div class="form-group mt-4{{ $errors->has('feature_name_'.$lng) ? 'has-error' : ''}}">
                                                            @foreach (config('locale.langs_code') as $key => $code)
                                                                @if ($lng == $key)
                                                                    {!! Form::label('feature_name_'.$lng, __('backend.home.name').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                                                @endif
                                                            @endforeach
                                                            {!! Form::text('feature_name_'.$lng, isset($home) && isset($home->feature_names) ? $home->feature_names[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                                            {!! $errors->first('feature_name_'.$lng, '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                        <div class="form-group mt-4{{ $errors->has('feature_title_'.$lng) ? 'has-error' : ''}}">
                                                            @foreach (config('locale.langs_code') as $key => $code)
                                                                @if ($lng == $key)
                                                                    {!! Form::label('feature_title_'.$lng, __('backend.home.title').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                                                @endif
                                                            @endforeach
                                                            {!! Form::text('feature_title_'.$lng, isset($home) && isset($home->feature_titles) ? $home->feature_titles[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                                            {!! $errors->first('feature_title_'.$lng, '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                        <div class="form-group mt-4{{ $errors->has('feature_description_'.$lng) ? 'has-error' : ''}}">
                                                            @foreach (config('locale.langs_code') as $key => $code)
                                                                @if ($lng == $key)
                                                                    {!! Form::label('feature_description_'.$lng, __('backend.home.description').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                                                @endif
                                                            @endforeach
                                                            {!! Form::textarea('feature_description_'.$lng, isset($home) && isset($home->feature_descriptions) ? $home->feature_descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                                            {!! $errors->first('feature_description_'.$lng, '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                        @if ($lng == 'en')
                                                            <div class="form-group mt-4{{ $errors->has('feature_link') ? 'has-error' : ''}}">
                                                                {!! Form::label('feature_link', __('backend.home.link'), ['class' => 'control-label required']) !!}
                                                                {!! Form::text('feature_link', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                                {!! $errors->first('feature_link', '<p class="help-block">:message</p>') !!}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    @if ($lng == 'en')
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="list-title mb-3">
                                                                        <label for="kt_ecommerce_add_product_store_template" class="form-label">
                                                                            <span style="color: #B5B5C3">{{ __('backend.common.image_size') }}( 371 x 218 )px</span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="panel-block">
                                                                        <div class="form-group">
                                                                            <div id="holder-feature-image" class="feature-remfly">
                                                                                @if(!empty($home->feature_image))
                                                                                    <div class='lfmimage-container feature-imagelfmc0'>
                                                                                        <img src="{{ asset($home->feature_image) }}" class='lfmimage w-100' style="height: 20rem;">
                                                                                        <button type="button" onclick="removeImage('feature-image',0)" class="btn btn-icon btn-active-light-danger btn btn-danger w-40px h-40px remove-image w-100" style="position: absolute; top: 150px; right: 50px;">
                                                                                            <i class='bi bi-trash'></i>
                                                                                        </button>
                                                                                    </div>
                                                                                @else
                                                                                    <img src="{{ asset('backend/media/remfly/images/blank-image.svg') }}" class="img-thumbnail">
                                                                                @endif
                                                                            </div>
                                                                            <div class="input-group mt-3">
                                                                                <span class="input-group-btn">
                                                                                    <a id="lfm-feature-image" data-input="feature-image" data-preview="holder-feature-image" class="btn btn-primary text-white">
                                                                                        <i class="bi bi-image-fill"></i>{{ __('backend.common.choose') }}
                                                                                    </a>
                                                                                </span>
                                                                                <input id="feature-image" class="form-control" type="text" name="feature_image" value="{{ isset($home->feature_image) ? $home->feature_image : '' }}">
                                                                            </div>  
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-4">
                                                                        <div class="col-md-12">
                                                                            {!! Form::label('feature_image_alt', 'Feature Image Alt', ['class' => 'control-label mb-3']) !!}
                                                                            {!! Form::text('feature_image_alt', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                                            {!! $errors->first('feature_image_alt', '<p class="help-block">:message</p>') !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="accordion" id="penfolds">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="penfolds">
                                            <button class="accordion-button fs-6 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#penfolds_max" aria-expanded="true" aria-controls="penfolds_max" style="padding: 1.1rem 1rem;">
                                                {{ __('backend.home.penfolds_max') }}
                                            </button>
                                        </h2>
                                        <div id="penfolds_max" class="accordion-collapse collapse" aria-labelledby="penfolds" data-bs-parent="#penfolds">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="@if ($lng == 'en') col-md-8 @else col-md-12 @endif">
                                                        <div class="form-group mt-4{{ $errors->has('penfold_name_'.$lng) ? 'has-error' : ''}}">
                                                            @foreach (config('locale.langs_code') as $key => $code)
                                                                @if ($lng == $key)
                                                                    {!! Form::label('penfold_name_'.$lng, __('backend.home.name').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                                                @endif
                                                            @endforeach
                                                            {!! Form::text('penfold_name_'.$lng, isset($home) && isset($home->penfold_names) ? $home->penfold_names[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                                            {!! $errors->first('penfold_name_'.$lng, '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                        <div class="form-group mt-4{{ $errors->has('penfold_title_'.$lng) ? 'has-error' : ''}}">
                                                            @foreach (config('locale.langs_code') as $key => $code)
                                                                @if ($lng == $key)
                                                                    {!! Form::label('penfold_title_'.$lng, __('backend.home.title').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                                                @endif
                                                            @endforeach
                                                            {!! Form::text('penfold_title_'.$lng, isset($home) && isset($home->penfold_titles) ? $home->penfold_titles[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                                            {!! $errors->first('penfold_title_'.$lng, '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                        <div class="form-group mt-4{{ $errors->has('penfold_description_'.$lng) ? 'has-error' : ''}}">
                                                            @foreach (config('locale.langs_code') as $key => $code)
                                                                @if ($lng == $key)
                                                                    {!! Form::label('penfold_description_'.$lng, __('backend.home.description').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                                                @endif
                                                            @endforeach
                                                            {!! Form::textarea('penfold_description_'.$lng, isset($home) && isset($home->penfold_descriptions) ? $home->penfold_descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                                            {!! $errors->first('penfold_description_'.$lng, '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                        @if ($lng == 'en')
                                                            <div class="form-group mt-4{{ $errors->has('penfold_link') ? 'has-error' : ''}}">
                                                                {!! Form::label('penfold_link', __('backend.home.link'), ['class' => 'control-label required']) !!}
                                                                {!! Form::text('penfold_link', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                                {!! $errors->first('penfold_link', '<p class="help-block">:message</p>') !!}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    @if ($lng == 'en')
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="list-title mb-3">
                                                                        <label for="kt_ecommerce_add_product_store_template" class="form-label">
                                                                            <span style="color: #B5B5C3">{{ __('backend.common.image_size') }}( 371 x 218 )px</span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="panel-block">
                                                                        <div class="form-group">
                                                                            <div id="holder-penfold-image" class="penfold-max">
                                                                                @if(!empty($home->penfold_image))
                                                                                    <div class='lfmimage-container penfold-imagelfmc0'>
                                                                                        <img src="{{ asset($home->penfold_image) }}" class='lfmimage w-100' style="height: 20rem;">
                                                                                        <button type="button" onclick="removeImage('penfold-image',0)" class="btn btn-icon btn-active-light-danger btn btn-danger w-40px h-40px remove-image w-100" style="position: absolute; top: 150px; right: 50px;">
                                                                                            <i class='bi bi-trash'></i>
                                                                                        </button>
                                                                                    </div>
                                                                                @else
                                                                                    <img src="{{ asset('backend/media/remfly/images/blank-image.svg') }}" class="img-thumbnail">
                                                                                @endif
                                                                            </div>
                                                                            <div class="input-group mt-3">
                                                                                <span class="input-group-btn">
                                                                                    <a id="lfm-penfold-image" data-input="penfold-image" data-preview="holder-penfold-image" class="btn btn-primary text-white">
                                                                                        <i class="bi bi-image-fill"></i>{{ __('backend.common.choose') }}
                                                                                    </a>
                                                                                </span>
                                                                                <input id="penfold-image" class="form-control" type="text" name="penfold_image" value="{{isset($home->penfold_image) ? $home->penfold_image : ''}}">
                                                                            </div>  
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-4">
                                                                        <div class="col-md-12">
                                                                            {!! Form::label('penfold_image_alt', 'Penfold Image Alt', ['class' => 'control-label mb-3']) !!}
                                                                            {!! Form::text('penfold_image_alt', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                                            {!! $errors->first('penfold_image_alt', '<p class="help-block">:message</p>') !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="accordion" id="Exclusive">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="Exclusive">
                                            <button class="accordion-button fs-6 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#member_exclusive" aria-expanded="true" aria-controls="member_exclusive" style="padding: 1.1rem 1rem;">
                                                {{ __('backend.home.member_exclusive_offer') }}
                                            </button>
                                        </h2>
                                        <div id="member_exclusive" class="accordion-collapse collapse" aria-labelledby="Exclusive" data-bs-parent="#Exclusive">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="@if ($lng == 'en') col-md-8 @else col-md-12 @endif">
                                                        <div class="form-group mt-4{{ $errors->has('exclusive_title_'.$lng) ? 'has-error' : ''}}">
                                                            @foreach (config('locale.langs_code') as $key => $code)
                                                                @if ($lng == $key)
                                                                    {!! Form::label('exclusive_title_'.$lng, __('backend.home.title').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                                                @endif
                                                            @endforeach
                                                            {!! Form::text('exclusive_title_'.$lng, isset($home) && isset($home->exclusive_titles) ? $home->exclusive_titles[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                                            {!! $errors->first('exclusive_title_'.$lng, '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                        <div class="form-group mt-4{{ $errors->has('exclusive_description_'.$lng) ? 'has-error' : ''}}">
                                                            @foreach (config('locale.langs_code') as $key => $code)
                                                                @if ($lng == $key)
                                                                    {!! Form::label('exclusive_description_'.$lng, __('backend.home.description').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                                                @endif
                                                            @endforeach
                                                            {!! Form::textarea('exclusive_description_'.$lng, isset($home) && isset($home->exclusive_descriptions) ? $home->exclusive_descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                                            {!! $errors->first('exclusive_description_'.$lng, '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                        @if ($lng == 'en')
                                                            <div class="form-group mt-4{{ $errors->has('exclusive_link') ? 'has-error' : ''}}">
                                                                {!! Form::label('exclusive_link', __('backend.home.link'), ['class' => 'control-label required']) !!}
                                                                {!! Form::text('exclusive_link', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                                {!! $errors->first('exclusive_link', '<p class="help-block">:message</p>') !!}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    @if ($lng == 'en')
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="list-title mb-3">
                                                                        <label for="kt_ecommerce_add_product_store_template" class="form-label">
                                                                            <span style="color: #B5B5C3">{{ __('backend.common.image_size') }}( 371 x 218 )px</span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="panel-block">
                                                                        <div class="form-group">
                                                                            <div id="holder-exclusive-image" class="member-exclusive">
                                                                                @if(!empty($home->exclusive_image))
                                                                                    <div class='lfmimage-container exclusive-imagelfmc0'>
                                                                                        <img src="{{ asset($home->exclusive_image) }}" class='lfmimage w-100' style="height: 20rem;">
                                                                                        <button type="button" onclick="removeImage('exclusive-image',0)" class="btn btn-icon btn-active-light-danger btn btn-danger w-40px h-40px remove-image w-100" style="position: absolute; top: 150px; right: 50px;">
                                                                                            <i class='bi bi-trash'></i>
                                                                                        </button>
                                                                                    </div>
                                                                                @else
                                                                                    <img src="{{ asset('backend/media/remfly/images/blank-image.svg') }}" class="img-thumbnail">
                                                                                @endif
                                                                            </div>
                                                                            <div class="input-group mt-3">
                                                                                <span class="input-group-btn">
                                                                                    <a id="lfm-exclusive-image" data-input="exclusive-image" data-preview="holder-exclusive-image" class="btn btn-primary text-white">
                                                                                        <i class="bi bi-image-fill"></i>{{ __('backend.common.choose') }}
                                                                                    </a>
                                                                                </span>
                                                                                <input id="exclusive-image" class="form-control" type="text" name="exclusive_image" value="{{isset($home->exclusive_image) ? $home->exclusive_image : ''}}">
                                                                            </div>  
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-4">
                                                                        <div class="col-md-12">
                                                                            {!! Form::label('exclusive_image_alt', 'Exclusive Image Alt', ['class' => 'control-label mb-3']) !!}
                                                                            {!! Form::text('exclusive_image_alt', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                                            {!! $errors->first('exclusive_image_alt', '<p class="help-block">:message</p>') !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="accordion" id="about">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="about">
                                            <button class="accordion-button fs-6 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#about_remfly" aria-expanded="true" aria-controls="about_remfly" style="padding: 1.1rem 1rem;">
                                                {{ __('backend.home.about_remfly') }}
                                            </button>
                                        </h2>
                                        <div id="about_remfly" class="accordion-collapse collapse" aria-labelledby="about" data-bs-parent="#about">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="@if ($lng == 'en') col-md-8 @else col-md-12 @endif">
                                                        <div class="form-group mt-4{{ $errors->has('about_title_'.$lng) ? 'has-error' : ''}}">
                                                            @foreach (config('locale.langs_code') as $key => $code)
                                                                @if ($lng == $key)
                                                                    {!! Form::label('about_title_'.$lng, __('backend.home.title').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                                                @endif
                                                            @endforeach
                                                            {!! Form::text('about_title_'.$lng, isset($home) && isset($home->about_titles) ? $home->about_titles[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                                            {!! $errors->first('about_title_'.$lng, '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                        <div class="form-group mt-4{{ $errors->has('about_description_'.$lng) ? 'has-error' : ''}}">
                                                            @foreach (config('locale.langs_code') as $key => $code)
                                                                @if ($lng == $key)
                                                                    {!! Form::label('about_description_'.$lng, __('backend.home.description').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                                                @endif
                                                            @endforeach
                                                            {!! Form::textarea('about_description_'.$lng, isset($home) && isset($home->about_descriptions) ? $home->about_descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                                            {!! $errors->first('about_description_'.$lng, '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                        @if ($lng == 'en')
                                                            <div class="form-group mt-4{{ $errors->has('about_link') ? 'has-error' : ''}}">
                                                                {!! Form::label('about_link', __('backend.home.link'), ['class' => 'control-label required']) !!}
                                                                {!! Form::text('about_link', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                                {!! $errors->first('about_link', '<p class="help-block">:message</p>') !!}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    @if ($lng == 'en')
                                                    <div class="col-md-4">
                                                        <div class="card">                                                            
                                                            <div class="card-body">
                                                                <div class="list-title mb-3">
                                                                    <label for="kt_ecommerce_add_product_store_template" class="form-label">
                                                                        <span style="color: #B5B5C3">{{ __('backend.common.image_size') }}( 371 x 218 )px</span>
                                                                    </label>
                                                                </div>
                                                                <div class="panel-block">
                                                                    <div class="form-group">
                                                                        <div id="holder-about-image" class="remfly-about">
                                                                            @if(!empty($home->about_image))
                                                                                <div class='lfmimage-container about-imagelfmc0'>
                                                                                    <img src="{{ asset($home->about_image) }}" class='lfmimage w-100' style="height: 20rem;">
                                                                                    <button type="button" onclick="removeImage('about-image',0)" class="btn btn-icon btn-active-light-danger btn btn-danger w-40px h-40px remove-image w-100" style="position: absolute; top: 150px; right: 50px;">
                                                                                        <i class='bi bi-trash'></i>
                                                                                    </button>
                                                                                </div>
                                                                            @else
                                                                                <img src="{{ asset('backend/media/remfly/images/blank-image.svg') }}" class="img-thumbnail">
                                                                            @endif
                                                                        </div>
                                                                        <div class="input-group mt-3">
                                                                            <span class="input-group-btn">
                                                                                <a id="lfm-about-image" data-input="about-image" data-preview="holder-about-image" class="btn btn-primary text-white">
                                                                                    <i class="bi bi-image-fill"></i>{{ __('backend.common.choose') }}
                                                                                </a>
                                                                            </span>
                                                                            <input id="about-image" class="form-control" type="text" name="about_image" value="{{isset($home->about_image) ? $home->about_image : ''}}">
                                                                        </div>  
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-4">
                                                                    <div class="col-md-12">
                                                                        {!! Form::label('about_image_alt', 'About Image Alt', ['class' => 'control-label mb-3']) !!}
                                                                        {!! Form::text('about_image_alt', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                                        {!! $errors->first('about_image_alt', '<p class="help-block">:message</p>') !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="accordion" id="store">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="store">
                                            <button class="accordion-button fs-6 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#store_distribution" aria-expanded="true" aria-controls="store_distribution" style="padding: 1.1rem 1rem;">
                                                {{ __('backend.home.store_distribution') }}
                                            </button>
                                        </h2>
                                        <div id="store_distribution" class="accordion-collapse collapse" aria-labelledby="store" data-bs-parent="#store">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="@if ($lng == 'en') col-md-8 @else col-md-12 @endif">
                                                        <div class="form-group mt-4{{ $errors->has('store_title_'.$lng) ? 'has-error' : ''}}">
                                                            @foreach (config('locale.langs_code') as $key => $code)
                                                                @if ($lng == $key)
                                                                    {!! Form::label('store_title_'.$lng, __('backend.home.title').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                                                @endif
                                                            @endforeach
                                                            {!! Form::text('store_title_'.$lng, isset($home) && isset($home->store_titles) ? $home->store_titles[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                                            {!! $errors->first('store_title_'.$lng, '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                        <div class="form-group mt-4{{ $errors->has('store_description_'.$lng) ? 'has-error' : ''}}">
                                                            @foreach (config('locale.langs_code') as $key => $code)
                                                                @if ($lng == $key)
                                                                    {!! Form::label('store_description_'.$lng, __('backend.home.description').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                                                @endif
                                                            @endforeach
                                                            {!! Form::textarea('store_description_'.$lng, isset($home) && isset($home->store_descriptions) ? $home->store_descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                                            {!! $errors->first('store_description_'.$lng, '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                        @if ($lng == 'en')
                                                            <div class="form-group mt-4{{ $errors->has('store_link') ? 'has-error' : ''}}">                                                   
                                                                {!! Form::label('store_link', __('backend.home.link'), ['class' => 'control-label required']) !!}
                                                                {!! Form::text('store_link', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                                {!! $errors->first('store_link', '<p class="help-block">:message</p>') !!}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    @if ($lng == 'en')
                                                        <div class="col-md-4">
                                                            <div class="card">                                                            
                                                                <div class="card-body">
                                                                    <div class="list-title mb-3">
                                                                        <label for="kt_ecommerce_add_product_store_template" class="form-label">
                                                                            <span style="color: #B5B5C3">{{ __('backend.common.image_size') }}( 371 x 218 )px</span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="panel-block">
                                                                        <div class="form-group">
                                                                            <div id="holder-store-image" class="store-distribution">
                                                                                @if(!empty($home->store_image))
                                                                                    <div class='lfmimage-container store-imagelfmc0'>
                                                                                        <img src="{{ asset($home->store_image) }}" class='lfmimage w-100' style="height: 20rem;">
                                                                                        <button type="button" onclick="removeImage('store-image',0)" class="btn btn-icon btn-active-light-danger btn btn-danger w-40px h-40px remove-image w-100" style="position: absolute; top: 150px; right: 50px;">
                                                                                            <i class='bi bi-trash'></i>
                                                                                        </button>
                                                                                    </div>
                                                                                @else
                                                                                    <img src="{{ asset('backend/media/remfly/images/blank-image.svg') }}" class="img-thumbnail">
                                                                                @endif
                                                                            </div>
                                                                            <div class="input-group mt-3">
                                                                                <span class="input-group-btn">
                                                                                    <a id="lfm-store-image" data-input="store-image" data-preview="holder-store-image" class="btn btn-primary text-white">
                                                                                        <i class="bi bi-image-fill"></i>{{ __('backend.common.choose') }}
                                                                                    </a>
                                                                                </span>
                                                                                <input id="store-image" class="form-control" type="text" name="store_image" value="{{isset($home->store_image) ? $home->store_image : ''}}">
                                                                            </div>  
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-4">
                                                                        <div class="col-md-12">
                                                                            {!! Form::label('store_image_alt', 'Store Image Alt', ['class' => 'control-label mb-3']) !!}
                                                                            {!! Form::text('store_image_alt', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                                            {!! $errors->first('store_image_alt', '<p class="help-block">:message</p>') !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($lng == 'en')
                            <div class="row mt-4">
                                <div class="col-md-12 text-end pb-5">
                                    <button type="button" class="addNewBrandLogo btn btn-icon btn-bg-success btn-sm">
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="#ffffff" class="bi bi-plus"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="month_row" id="month-row">
                                    @if (isset($home) && isset($home->brand_logo) && count($home->brand_logo) > 0)
                                        @foreach ($home->brand_logo as $key => $detail)
                                            @php $index=$key @endphp
                                            @include('admin.home.brand-logo')
                                        @endforeach
                                    @else
                                        @php $index=0 @endphp
                                        @include('admin.home.brand-logo')
                                    @endif
                                <div id="getNewBrandLogo" class="getNewBrandLogo"></div>
                                </div>
                            </div>
                        @endif
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
                                                    {!! Form::text('meta_title_'.$lng, isset($home) && isset($home->meta_titles) ? $home->meta_titles[$lng] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
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
                                                    {!! Form::textarea('meta_description_'.$lng, isset($home) && isset($home->meta_descriptions) ? $home->meta_descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control h-150px', 'required' => 'required'] : ['class' => 'form-control h-150px']) !!}
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
                                                            @if(!empty($home->meta_image))
                                                                <div class='lfmimage-container meta-imagelfmc0'>
                                                                    <img src="{{ asset($home->meta_image) }}" class='lfmimage w-100' style="height: 20rem;">
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
                                                        <input id="meta-image" class="form-control" type="text" name="meta_image" value="{{isset($home) ? $home->meta_image : ''}}">
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
</div>
@push('scripts')

<script>
    $(document).on('click', '.lfm', function() {
        $(this).filemanager('file');
    })

    var index = parseInt($(".indices:last").data("id"));
    $('.addNewBrandLogo').on('click', function() {
        console.log('click');
        index += 1;
        $('#index').val(index);
        $.ajax({
            type: "POST",
            url: "{{ url('admin/get-brand-logo') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                index: index
            },
            datatype: 'json',
            success: function(json) {
                $('#getNewBrandLogo').append(json[0]);
            }
        });
    })

    for (let i = 0; i < 100; i++) {
        $(document).on('click', `.removeBrandLogo${i}`, function() {
            $(`#accordionExample${i}`).remove()
        })

    }
</script>
<script>
    $('#lfm-feature-image').filemanager('file');
    $('#lfm-penfold-image').filemanager('file');
    $('#lfm-exclusive-image').filemanager('file');
    $('#lfm-about-image').filemanager('file');
    $('#lfm-store-image').filemanager('file');
    $('#lfm-meta-image').filemanager('file');
</script>
@endpush
