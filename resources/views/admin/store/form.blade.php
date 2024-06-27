<div class="row">
    <div class="col-md-8">
        <h2 class="fs-1">@if($formMode == "edit") {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.store') }}</h2>
    </div>
    <div class="col-md-4 text-end">
        <div class="form-group">
            <div class="form-group">
                <div class="float-left">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                        {{ __('backend.common.save') }}</button>
                    <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('/admin/store') }}'"><i class="bi bi-x"
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
                                        {!! Form::label('name_'.$lng, __('backend.store.name').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                    @endif
                                @endforeach
                                {!! Form::text('name_'.$lng, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                {!! $errors->first('name_'.$lng, '<p class="text-danger">:message</p>') !!}
                            </div>
                            <div class="form-group mt-4{{ $errors->has('addresses_'.$lng) ? 'has-error' : ''}}">
                                @foreach (config('locale.langs_code') as $key => $code)
                                    @if ($lng == $key)
                                        {!! Form::label('address_'.$lng, __('backend.store.address').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                    @endif
                                @endforeach
                                {!! Form::text('addresses_'.$lng, isset($store) && isset($store->addresses) ? $store->addresses[$lng] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                {!! $errors->first('addresses_'.$lng, '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    @endforeach     
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                {!! Form::label('email', __('backend.store.email'), ['class' => 'control-label mb-3 required']) !!}
                                {!! Form::text('email', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('phone') ? 'has-error' : ''}}">
                                {!! Form::label('phone', __('backend.store.phone'), ['class' => 'control-label mb-3 required']) !!}
                                {!! Form::text('phone', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
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
                       <div id="holder-store-image">
                            @if(!empty($store->store_image))
                                <div class='lfmimage-container store-imagelfmc0'>
                                    <img src="{{ asset($store->store_image) }}" class='lfmimage w-100' style="height: 20rem;">
                                    <div>
                                        <button type="button" onclick="removeImage('store-image',0)" class="btn btn-icon btn-active-light-danger btn btn-danger w-40px h-40px remove-image w-100" style="position: absolute; top: 150px; right: 50px;">
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
                                <a id="lfm-store-image" data-input="store-image" data-preview="holder-store-image" class="btn btn-primary text-white">
                                    <i class="bi bi-image-fill"></i>{{ __('backend.common.choose') }}
                                </a>
                            </span>
                            <input id="store-image" class="form-control" type="text" name="store_image" value="{{isset($store) ? $store->store_image : ''}}">
                       </div> 
                       {!! $errors->first('store_image', '<p class="help-block">:message</p>') !!} 
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
</div>
@push('scripts')
<script src="{{ asset('backend/js/gallery.js') }}"></script>
<script>
    // $('#lfm-pro').filemanager('gallery');
    $('#lfm-store-image').filemanager('file');
</script>
@endpush
