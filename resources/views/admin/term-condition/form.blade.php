<div class="row">
    <div class="col-md-8">
        <h2 class="fs-1">@if($formMode == "edit") {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.term_condition') }}</h2>
    </div>
    <div class="col-md-4 text-end">
        <div class="form-group">
            <div class="form-group">
                <div class="float-left">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                        {{ __('backend.common.save') }}</button>
                    <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('/admin/term-condition') }}'"><i class="bi bi-x"
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
                                <div class="form-group {{ $errors->has('title_'.$lng) ? 'has-error' : ''}}">
                                    @foreach (config('locale.langs_code') as $key => $code)
                                        @if ($lng == $key)
                                            {!! Form::label('title_'.$lng, __('backend.term_condition.title').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                        @endif
                                    @endforeach
                                    {!! Form::text('title_'.$lng, isset($termcondition) && isset($termcondition->title) ? $termcondition->title[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                    {!! $errors->first('title_'.$lng, '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>     
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('description_'.$lng) ? 'has-error' : ''}}">
                                    @foreach (config('locale.langs_code') as $key => $code)
                                        @if ($lng == $key)
                                            {!! Form::label('description_'.$lng, __('backend.term_condition.description').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                        @endif
                                    @endforeach
                                    {!! Form::textarea('description_'.$lng, isset($termcondition) && isset($termcondition->description) ? $termcondition->description[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
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
                                                    {!! Form::text('meta_title_'.$lng, isset($termcondition) && isset($termcondition->meta_titles) ? $termcondition->meta_titles[$lng] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
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
                                                    {!! Form::textarea('meta_description_'.$lng, isset($termcondition) && isset($termcondition->meta_descriptions) ? $termcondition->meta_descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control h-150px', 'required' => 'required'] : ['class' => 'form-control h-150px']) !!}
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
                                                            @if(!empty($termcondition->meta_image))
                                                                <div class='lfmimage-container meta-imagelfmc0'>
                                                                    <img src="{{ asset($termcondition->meta_image) }}" class='lfmimage w-100' style="height: 20rem;">
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
                                                            <input id="meta-image" class="form-control" type="text" name="meta_image" value="{{isset($termcondition) ? $termcondition->meta_image : ''}}">
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
</div>
@push('scripts')
<script>
    $('#lfm-meta-image').filemanager('file');
</script>
@endpush
