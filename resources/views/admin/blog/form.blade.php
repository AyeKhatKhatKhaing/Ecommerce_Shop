<div class="row">
    <div class="col-md-8">
        <h2 class="fs-1">@if($formMode == "edit") {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.blog') }}</h2>
    </div>
    <div class="col-md-4 text-end">
        <div class="form-group">
            <div class="form-group">
                <div class="float-left">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                        {{ __('backend.common.save') }}</button>
                    <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('admin/blog') }}'"><i class="bi bi-x"
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('title_'.$lng) ? 'has-error' : ''}}">
                                    @foreach (config('locale.langs_code') as $key => $code)
                                        @if ($lng == $key)
                                            {!! Form::label('title_'.$lng, __('backend.blog.title').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                        @endif
                                    @endforeach
                                    {!! Form::text('title_'.$lng, isset($blog) && isset($blog->titles) ? $blog->titles[$lng] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                    {!! $errors->first('title_'.$lng, '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('short_description_'.$lng) ? 'has-error' : ''}}">
                                    @foreach (config('locale.langs_code') as $key => $code)
                                        @if ($lng == $key)
                                            {!! Form::label('short_description_'.$lng,  __('backend.blog.short_description').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                        @endif
                                    @endforeach
                                    {!! Form::textarea('short_description_'.$lng, isset($blog) && isset($blog->short_descriptions) ? $blog->short_descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                    {!! $errors->first('short_description_'.$lng, '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('description_'.$lng) ? 'has-error' : ''}}">
                                    @foreach (config('locale.langs_code') as $key => $code)
                                        @if ($lng == $key)
                                            {!! Form::label('description_'.$lng,  __('backend.blog.description').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                        @endif
                                    @endforeach
                                    {!! Form::textarea('description_'.$lng, isset($blog) && isset($blog->descriptions) ? $blog->descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                    {!! $errors->first('description_'.$lng, '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="card mt-5">
                            <div class="card-header border-0 ps-0">
                                <div class="card-title">{{  __('backend.seo.search_engine_optimize') }}</div>
                            </div>
                            <div class="card-body ps-0 pe-0">
                                <div class="row">
                                    <div class="@if ($lng == 'en') col-md-6 @else col-md-12 @endif">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group{{ $errors->has('meta_title_'.$lng) ? 'has-error' : ''}}">
                                                    @foreach (config('locale.langs_code') as $key => $code)
                                                        @if ($lng == $key)
                                                            {!! Form::label('meta_title_'.$lng,  __('backend.seo.meta_title').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                                        @endif
                                                    @endforeach
                                                    {!! Form::text('meta_title_'.$lng, isset($blog) && isset($blog->meta_titles) ? $blog->meta_titles[$lng] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                    {!! $errors->first('meta_title_'.$lng, '<p class="help-block">:message</p>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="form-group{{ $errors->has('meta_description_'.$lng) ? 'has-error' : ''}}">
                                                    @foreach (config('locale.langs_code') as $key => $code)
                                                        @if ($lng == $key)
                                                            {!! Form::label('meta_description'.$lng,  __('backend.seo.meta_description').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                                        @endif
                                                    @endforeach
                                                    {!! Form::textarea('meta_description_'.$lng, isset($blog) && isset($blog->meta_descriptions) ? $blog->meta_descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control h-150px', 'required' => 'required'] : ['class' => 'form-control h-150px']) !!}
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
                                                        <span style="color: #B5B5C3">{{  __('backend.common.image_size') }}(1200 x 630)px</span>
                                                    </label>
                                                </div>
                                                <div class="panel-block">
                                                    <div class="form-group">
                                                    <div id="holder-meta-image">
                                                            @if(!empty($blog->meta_image))
                                                                <div class='lfmimage-container meta-imagelfmc0'>
                                                                    <img src="{{ asset($blog->meta_image) }}" class='lfmimage w-100' style="height: 20rem;">
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
                                                                    <i class="bi bi-image-fill"></i>{{  __('backend.common.choose') }}
                                                                </a>
                                                            </span>
                                                            <input id="meta-image" class="form-control" type="text" name="meta_image" value="{{isset($blog) ? $blog->meta_image : ''}}">
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
                <h3 class="card-title">{{  __('backend.common.image') }}</h3>
            </div>
            <div class="card-body">
                <div class="list-title mb-3">
                    <label for="kt_ecommerce_add_product_store_template" class="form-label">
                        <span style="color: #B5B5C3">{{  __('backend.common.image_size') }}( 371 x 218 )px</span>
                    </label>
                </div>
                <div class="panel-block">
                    <div class="form-group">
                       <div id="holder-blog-image">
                            @if(!empty($blog->blog_image))
                                <div class='lfmimage-container blog-imagelfmc0'>
                                    <img src="{{ asset($blog->blog_image) }}" class='lfmimage w-100' style="height: 20rem;">
                                    <div>
                                        <button type="button" onclick="removeImage('blog-image',0)" class="btn btn-icon btn-active-light-danger btn btn-danger w-40px h-40px remove-image w-100" style="position: absolute; top: 150px; right: 50px;">
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
                                <a id="lfm-blog-image" data-input="blog-image" data-preview="holder-blog-image" class="btn btn-primary text-white">
                                    <i class="bi bi-image-fill"></i>{{  __('backend.common.choose') }}
                                </a>
                            </span>
                            <input id="blog-image" class="form-control" type="text" name="blog_image" value="{{isset($blog) ? $blog->blog_image : ''}}">
                       </div>  
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        {!! Form::label('blog_image_alt', 'Blog Image Alt', ['class' => 'control-label mb-3']) !!}
                        {!! Form::text('blog_image_alt', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                        {!! $errors->first('blog_image_alt', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <div class="card-title">{{  __('backend.blog.blog_category') }}</div>
            </div>
            <div class="card-body" style="overflow-y: scroll;max-height: 200px;">
                <div class="overflow">
                    <div class="overflow-hidden">
                        @foreach ($blogcategory as $category)
                            <div class="form-check mb-5"><input type="radio" name="category_id" class="form-check-input page-radio" 
                                style="margin-top: 0;"
                                    {{ isset($blog) ? $category->id == $blog->category_id ? 'checked' : '' : ''}} value="{{ $category->id }}"/>
                                {{ $category->names['en'] }}</div>
                        @endforeach
                    </div>
                </div>    
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">
                    {{  __('backend.blog.publish_status') }}
                </h3>
            </div>
            <div class="card-body">
                <div class="card-body pt-0" style="padding-left: 0 !important; padding-right: 0 !important;">
                    <div class="d-flex justify-content nopadding">
                        <label for="" class="control-label">{{  __('backend.blog.current_status') }}</label>
                        @if(isset($blog))
                            @if($blog->published_status == 1 )
                                <p style="padding-left: 15px;">{{  __('backend.blog.published') }}</p>
                            @else
                                <p style="padding-left: 15px;">{{  __('backend.blog.draft') }}</p>
                            @endif
                        @else
                            <p style="padding-left: 15px;">{{  __('backend.blog.draft') }}</p>
                        @endif
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-3 mt-2 publish-change-to">
                            {{  __('backend.blog.change_to') }}
                        </div>
                        <div class="col-md-4 publish-status">
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-center">
                                    <select class="filters form-select form-select-sm" data-control="select2" data-hide-search="true" placeholder="Select" data-placeholder="Select" style="min-width: 95px;" name="published_status" id="published-status">
                                        <option></option>
                                        <option value="1" @if(isset($blog)) {{ $blog->published_status == 1 ? 'selected' : '' }} @endif>Published</option>
                                        <option value="0" @if(isset($blog)) {{ $blog->published_status == 0 ? 'selected' : '' }} @endif>Draft</option>
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-1 mt-2 publish-on" style="padding : 0; text-align: center;">
                            {{  __('backend.blog.on') }}
                        </div>
                        <div class="col-md-4 publish-date">
                            <div class="form-group{{ $errors->has('published_date') ? 'has-error' : ''}}">
                                {!! Form::input('date','published_date', null, ('' == 'required') ? ['class' => 'form-control'] : ['class' => 'form-control published-date']) !!}
                                {!! $errors->first('published_date', '<p class="help-block">:message</p>') !!}
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('#lfm-blog-image').filemanager('file');
        $('#lfm-meta-image').filemanager('file');
    </script>
@endpush