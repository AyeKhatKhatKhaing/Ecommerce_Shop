<div class="row">
    <div class="col-md-8">
        <h2 class="fs-1">@if($formMode == "edit") {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.category') }}</h2>
    </div>
    <div class="col-md-4 text-end">
        <div class="form-group">
            <div class="form-group">
                <div class="float-left">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                        {{ __('backend.common.save') }}</button>
                    <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('/admin/category') }}'"><i class="bi bi-x"
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
                        <div class="form-group{{ $errors->has('name_'.$lng) ? 'has-error' : ''}}">
                            @foreach (config('locale.langs_code') as $key => $code)
                                @if ($lng == $key)
                                    {!! Form::label('name_'.$lng,  __('backend.categories.name').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                @endif
                            @endforeach
                            {!! Form::text('name_'.$lng, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('name_'.$lng, '<p class="text-danger">:message</p>') !!}
                        </div>
                        {{-- <div class="mb-3 form-group mt-4">
                            <div class="list-title mb-3">
                                {!! Form::label('main_category_id', __('backend.categories.parent_category'), ['class' => 'from-label']) !!}
                            </div>
                            {!! Form::select('parent_id', ['' => 'Select parent category']+$categories, null , ['class' => 'form-select', 'data-control' => 'select2', 'data-hide-search' => "true", 'data-placeholder' => __('backend.categories.select_parent_category'),  "data-kt-ecommerce-product-filter" => "parent_id"]) !!}
                        </div> --}}
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
                        <div id="holder-category-image">
                            @if(!empty($category->image))
                                <div class='lfmimage-container category-imagelfmc0'>
                                    <img src="{{ asset($category->image) }}" class='lfmimage w-100' style="height: 20rem;">
                                    <button type="button" onclick="removeImage('category-image',0)" class="btn btn-icon btn-active-light-danger btn btn-danger w-40px h-40px remove-image w-100" style="position: absolute; top: 150px; right: 50px;">
                                        <i class='bi bi-trash'></i>
                                    </button>
                                </div>
                            @else
                                <img src="{{ asset('backend/media/remfly/images/blank-image.svg') }}" class="img-thumbnail">
                            @endif
                        </div>
                        <div class="input-group mt-3">
                            <span class="input-group-btn">
                                <a id="lfm-category-image" data-input="category-image" data-preview="holder-category-image" class="btn btn-primary text-white">
                                    <i class="bi bi-image-fill"></i>{{ __('backend.common.choose') }}
                                </a>
                            </span>
                            <input id="category-image" class="form-control" type="text" name="image" value="{{isset($category->image) ? $category->image : ''}}">
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <div class="d-flex justify-content-between nopadding">
                    <label for="is_other" class="control-label fs-4 fw-bold">Is Other</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_other" id="is_other" {{ isset($category) && $category->is_other == 1 ? 'checked' : ''  }}>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <div class="card-title">
                    {{ __('backend.categories.sort') }}
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
    $('#lfm-category-image').filemanager('file');
</script>
@endpush

