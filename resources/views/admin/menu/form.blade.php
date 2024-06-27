<div class="row">
    <div class="col-md-8">
        <h2 class="fs-1">@if($formMode == "edit") {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.menu') }}</h2>
    </div>
    <div class="col-md-4 text-end">
        <div class="form-group">
            <div class="form-group">
                <div class="float-left">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                        {{ __('backend.common.save') }}</button>
                    <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('admin/menu') }}'"><i class="bi bi-x"
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
                            <div class="form-group{{ $errors->has('type') ? 'has-error' : ''}}">
                                {!! Form::label('type',  __('backend.menu.type'), ['class' => 'control-label mb-3']) !!}
                                <select class="form-select {{ isset($menu) && isset($menu->type) ? 'form-select-solid' : '' }}" data-control="select2" data-hide-search="true" data-placeholder="{{ __('backend.menu.select_coupon_type') }}" id="menu-type" name="type" data-select2-id="select2-data-type" tabindex="-1" aria-hidden="true" {{ isset($menu) && isset($menu->type) ? 'disabled' : '' }}>
                                    <option></option>
                                    @foreach (config('general.menu_type') as $menu_value => $value)
                                        <option value="{{ $menu_value }}" {{ isset($menu) && $menu->type == $menu_value ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 {{ isset($menu) && isset($menu->category_id) ? '' : 'd-none' }}" id="category-row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('category_id') ? 'has-error' : ''}}">
                                {!! Form::label('category_id', __('backend.menu.category'), ['class' => 'control-label mb-3 required']) !!}
                                {!! Form::select('category_id', $categories, null,  ['class' => 'form-select', 'data-control' => 'select2', 'data-hide-search' => "true", 'placeholder' => 'Select Category', 'data-placeholder' => __('backend.menu.select_category')]) !!}
                                {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 {{ isset($menu) && isset($menu->countries) ? '' : 'd-none' }}" id="country-row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('countries') ? 'has-error' : ''}}">
                                {!! Form::label('countries', __('backend.menu.country'), ['class' => 'control-label mb-3 required']) !!}
                                {!! Form::select('countries[]', $countries, null,  ['class' => 'form-select', 'data-control' => 'select2', 'data-hide-search' => "true", 'data-placeholder' => __('backend.menu.select_country'), 'multiple' => 'multiple', 'data-allow-clear' => 'true']) !!}
                                {!! $errors->first('countries', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 {{ isset($menu) && isset($menu->promotions) ? '' : 'd-none' }}" id="promotion-row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('promotions') ? 'has-error' : ''}}">
                                {!! Form::label('promotions', __('backend.menu.promotion'), ['class' => 'control-label mb-3 required']) !!}
                                {!! Form::select('promotions[]', $promotions, null,  ['class' => 'form-select', 'data-control' => 'select2', 'data-hide-search' => "true", 'data-placeholder' => __('backend.menu.select_promotion'), 'multiple' => 'multiple', 'data-allow-clear' => 'true']) !!}
                                {!! $errors->first('promotions', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    @foreach (config('locale.langs') as $lng => $attr)
                        <div class="tab-pane fade {{ $lng == 'en' ? 'active show' : '' }}"  id="{{ strtolower($lng) }}-tab">
                            <div class="row mt-4">    
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('name_'.$lng) ? 'has-error' : ''}}">
                                        @foreach (config('locale.langs_code') as $key => $code)
                                            @if ($lng == $key)
                                                {!! Form::label('name_'.$lng, __('backend.menu.menu_name').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                            @endif
                                        @endforeach
                                        {!! Form::text('name_'.$lng, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('name_'.$lng, '<p class="text-danger">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('description_'.$lng) ? 'has-error' : ''}}">
                                        @foreach (config('locale.langs_code') as $key => $code)
                                            @if ($lng == $key)
                                                {!! Form::label('description_'.$lng, __('backend.menu.menu_description').'('.$code.')', ['class' => 'control-label mb-3']) !!}
                                            @endif
                                        @endforeach
                                        {!! Form::textarea('description_'.$lng, isset($membertype) && isset($membertype->descriptions) ? $membertype->descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                        {!! $errors->first('description_'.$lng, '<p class="help-block">:message</p>') !!}
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
                        <span style="color: #B5B5C3">{{ __('backend.common.image_size') }}(427px x 258px)</span>
                    </label>
                </div>
                <div class="panel-block">
                    <div class="form-group">
                       <div id="holder-menu-image">
                            @if(!empty($menu->image))
                                <div class='lfmimage-container menu-imagelfmc0'>
                                    <img src="{{ isset($menu->image) ? asset($menu->image) : asset(old('image')) }}" class='lfmimage w-100' style="height: 20rem;">
                                    <div>
                                        <button type="button" onclick="removeImage('menu-image',0)" class="btn btn-icon btn-active-light-danger btn btn-danger w-40px h-40px remove-image w-100" style="position: absolute; top: 150px; right: 50px;">
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
                                <a id="lfm-menu-image" data-input="menu-image" data-preview="holder-menu-image" class="btn btn-primary text-white">
                                    <i class="bi bi-image-fill"></i>{{ __('backend.common.choose') }}
                                </a>
                            </span>
                            <input id="menu-image" class="form-control" type="text" name="image" value="{{isset($menu) ? $menu->image : old('image')}}">
                       </div>  
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        {!! Form::label('image_alt', 'Menu Image Alt', ['class' => 'control-label mb-3']) !!}
                        {!! Form::text('image_alt', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                        {!! $errors->first('image_alt', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <div class="d-flex justify-content-between nopadding">
                    <label for="show_submenu" class="control-label fs-4 fw-bold">{{ __('backend.menu.show_submenu') }}</label>
                    <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="show_submenu" id="show_submenu" {{ isset($menu) && $menu->show_submenu == 1 ? 'checked' : '' }}>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <div class="card-title">
                    {{ __('backend.menu.sort') }}
                </div>
            </div>
            <div class="card-body">
                <div class="form-group{{ $errors->has('sort') ? 'has-error' : ''}}">
                    {!! Form::number('sort', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                    {!! $errors->first('sort', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('#lfm-menu-image').filemanager('file');
    </script>
    <script>
        var type   =  $('#menu-type').val();

        if (type == 'category') {
            $('#category-row').removeClass('d-none');
            $('#country-row').removeClass('d-none');
            $('select[name="promotions[]"]').val('');
        }

        if (type == 'promotion') {
            $('#promotion-row').removeClass('d-none');
            $('select[name="category_id"]').val('');
            $('select[name="countries[]"]').val('');
        }

        $('#menu-type').on('change', function() {
            var type_name = $(this).val();

            $('#category-row').addClass('d-none');
            $('#country-row').addClass('d-none');
            $('#promotion-row').addClass('d-none');

            if (type_name == 'category') {
                $('#category-row').removeClass('d-none');
                $('#country-row').removeClass('d-none');
                $('select[name="promotions[]"]').val('');
            }

            if (type_name == 'promotion') {
                $('#promotion-row').removeClass('d-none');
                $('select[name="category_id"]').val('');
                $('select[name="countries[]"]').val('');
            }
        })
    </script>
@endpush