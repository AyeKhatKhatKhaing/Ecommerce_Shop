<div class="row">
    <div class="col-md-8">
        <h2 class="fs-1">@if($formMode == "edit") {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.pages') }}</h2>
    </div>
    <div class="col-md-4 text-end">
        <div class="form-group">
            <div class="form-group">
                <div class="float-left">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                        {{ __('backend.common.save') }}</button>
                    <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('/admin/page') }}'"><i class="bi bi-x"
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
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('page_type', __('backend.page.page_type'), ['class' => 'from-label mb-3 required']) !!}
                            {!! Form::select('page_type', Admin::getPageTypes(), null, ['class' => 'form-select form-select-solid', 'data-control' => 'select2', 'data-hide-search' => "true", 'data-placeholder' => "Select Page Type"]) !!}
                            {!! $errors->first('page_type', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="row mt-4 d-none" id="selectCategory">
                        <div class="col-md-12">
                            {!! Form::label('name', __('backend.page.category'), ['class' => 'from-label mb-3 required']) !!}
                            {!! Form::select('category_id',$categories, null, ['class' => 'form-select form-select-solid', 'data-control' => 'select2', 'data-hide-search' => "true", 'data-placeholder' => "Select Category"]) !!}
                            {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div> 
                    @foreach (config('locale.langs') as $lng => $attr)
                        <div class="tab-pane fade {{ $lng == 'en' ? 'active show' : '' }}"  id="{{ strtolower($lng) }}-tab">  
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('title_'.$lng) ? 'has-error' : ''}}">
                                        @foreach (config('locale.langs_code') as $key => $code)
                                            @if ($lng == $key)
                                                {!! Form::label('title_'.$lng, __('backend.page.title').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                            @endif
                                        @endforeach
                                        {!! Form::text('title_'.$lng, isset($page) && isset($page->titles) ? $page->titles[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                        {!! $errors->first('title_'.$lng, '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>  
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('description_'.$lng) ? 'has-error' : ''}}">
                                        @foreach (config('locale.langs_code') as $key => $code)
                                            @if ($lng == $key)
                                                {!! Form::label('description_'.$lng, __('backend.page.description').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                            @endif
                                        @endforeach
                                        {!! Form::textarea('description_'.$lng, isset($page) && isset($page->descriptions) ? $page->descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                        {!! $errors->first('description_'.$lng, '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
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
                                                        {!! Form::text('meta_title_'.$lng, isset($page) && isset($page->meta_titles) ? $page->meta_titles[$lng] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                        {!! $errors->first('meta_title_'.$lng, '<p class="help-block">:message</p>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="form-group{{ $errors->has('meta_description_'.$lng) ? 'has-error' : ''}}">
                                                        @foreach (config('locale.langs_code') as $key => $code)
                                                            @if ($lng == $key)
                                                                {!! Form::label('meta_description_'.$lng,  __('backend.seo.meta_description').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                                            @endif
                                                        @endforeach
                                                        {!! Form::textarea('meta_description_'.$lng, isset($page) && isset($page->meta_descriptions) ? $page->meta_descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control h-150px', 'required' => 'required'] : ['class' => 'form-control h-150px']) !!}
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
                                                                @if(!empty($page->meta_image))
                                                                    <div class='lfmimage-container meta-imagelfmc0'>
                                                                        <img src="{{ asset($page->meta_image) }}" class='lfmimage w-100' style="height: 20rem;">
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
                                                                        <i class="bi bi-image-fill"></i>{{ __('backend.common.edit') }}
                                                                    </a>
                                                                </span>
                                                                <input id="meta-image" class="form-control" type="text" name="meta_image" value="{{isset($page) ? $page->meta_image : ''}}">
                                                        </div>  
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
                        <div id="holder-page-image">
                            @if(!empty($page->image))
                                <div class='lfmimage-container page-imagelfmc0'>
                                    <img src="{{ asset($page->image) }}" class='lfmimage w-100' style="height: 20rem;">
                                    <button type="button" onclick="removeImage('page-image',0)" class="btn btn-icon btn-active-light-danger btn btn-danger w-40px h-40px remove-image w-100" style="position: absolute; top: 150px; right: 50px;">
                                        <i class='bi bi-trash'></i>
                                    </button>
                                </div>
                            @else
                                <img src="{{ asset('backend/media/remfly/images/blank-image.svg') }}" class="img-thumbnail">
                            @endif
                        </div>
                        <div class="input-group mt-3">
                            <span class="input-group-btn">
                                <a id="lfm-page-image" data-input="page-image" data-preview="holder-page-image" class="btn btn-primary text-white">
                                    <i class="bi bi-image-fill"></i>{{ __('backend.common.choose') }}
                                </a>
                            </span>
                            <input id="page-image" class="form-control" type="text" name="image" value="{{isset($page->image) ? $page->image : ''}}">
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
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {
        $('select[name=page_type]').on('change', function () {
            if ($(this).val() === 'category') { 
                $('#selectCategory').removeClass('d-none');
            }else {
                $('#selectCategory').addClass('d-none');
            }
        });
    });
    $('#lfm-page-image').filemanager('file');
    $('#lfm-meta-image').filemanager('file');

</script>
@endpush