<div class="row">
    <div class="col-md-8">
        <h2 class="fs-1">@if($formMode == "edit") {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.products') }}</h2>
    </div>
    <div class="col-md-4 text-end">
        <div class="form-group">
            <div class="form-group">
                <div class="float-left">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                        {{ __('backend.common.save') }}</button>
                    <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('admin/other-product') }}'"><i class="bi bi-x"
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
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('type') ? 'has-error' : ''}}">
                                {!! Form::label('type', __('backend.other_product.type'), ['class' => 'control-label mb-3']) !!}
                                {!! Form::select('type',['hk'=>'Hong Kong','ma'=>'Macau'], $formMode=="edit" ? $other_product->type : null, ['class' => 'form-select', 'data-control' => 'select2', 'data-hide-search' => "true", 'data-placeholder' => "Select Location", 'placeholder' => 'Select Location'],['id' => 'location-select']) !!}
                                {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    @foreach (config('locale.langs') as $lng => $attr)
                        <div class="tab-pane fade {{ $lng == 'en' ? 'active show' : '' }}"  id="{{ strtolower($lng) }}-tab">    
                            <label for="header" class="fw-bold fs-5 pt-0">{{ __('backend.products.product_information') }}</label>  
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('name_'.$lng) ? 'has-error' : ''}}">
                                        @foreach (config('locale.langs_code') as $key => $code)
                                            @if ($lng == $key)
                                                {!! Form::label('name_'.$lng, __('backend.products.name').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                            @endif
                                        @endforeach
                                        {!! Form::text('name_'.$lng, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('name_'.$lng, '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('offer_label_'.$lng) ? 'has-error' : ''}}">
                                        @foreach (config('locale.langs_code') as $key => $code)
                                            @if ($lng == $key)
                                                {!! Form::label('offer_label_'.$lng, __('backend.products.offer_label').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                            @endif
                                        @endforeach
                                        {!! Form::text('offer_label_'.$lng, isset($other_product) && isset($other_product->offer_labels) ? $other_product->offer_labels[$lng] : '', ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('offer_label_'.$lng, '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="accordion" id="content">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="content">
                                                <button class="accordion-button fs-6 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#product_content" aria-expanded="true" aria-controls="product_content" style="padding: 1.1rem 1rem;">
                                                    @foreach (config('locale.langs_code') as $key => $code)
                                                        @if ($lng == $key)
                                                            {{ __('backend.products.content') }} ({{ $code }})
                                                        @endif
                                                    @endforeach
                                                </button>
                                            </h2>
                                            <div id="product_content" class="accordion-collapse collapse" aria-labelledby="content" data-bs-parent="#content">
                                                <div class="accordion-body">
                                                    <div class="form-group{{ $errors->has('content_'.$lng) ? 'has-error' : ''}}">
                                                        {!! Form::text('content_'.$lng, isset($other_product) && isset($other_product->product_meta->contents) ? $other_product->product_meta->contents[$lng] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                        {!! $errors->first('content_'.$lng, '<p class="help-block">:message</p>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="accordion" id="description">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="description">
                                                <button class="accordion-button fs-6 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#product_description" aria-expanded="true" aria-controls="product_description" style="padding: 1.1rem 1rem;">
                                                    @foreach (config('locale.langs_code') as $key => $code)
                                                        @if ($lng == $key)
                                                            {{ __('backend.products.description') }} ({{ $code }})
                                                        @endif
                                                    @endforeach
                                                </button>
                                            </h2>
                                            <div id="product_description" class="accordion-collapse collapse" aria-labelledby="description" data-bs-parent="#description">
                                                <div class="accordion-body">
                                                    <div class="form-group{{ $errors->has('description_'.$lng) ? 'has-error' : ''}}">
                                                        {!! Form::textarea('description_'.$lng, isset($other_product) && isset($other_product->product_meta->descriptions) ? $other_product->product_meta->descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                                        {!! $errors->first('description_'.$lng, '<p class="help-block">:message</p>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="accordion" id="testing_note">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="testing_note">
                                                <button class="accordion-button fs-6 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#product_testing_note" aria-expanded="true" aria-controls="product_testing_note" style="padding: 1.1rem 1rem;">
                                                    @foreach (config('locale.langs_code') as $key => $code)
                                                        @if ($lng == $key)
                                                            {{ __('backend.products.tasting_note') }} ({{ $code }})
                                                        @endif
                                                    @endforeach
                                                </button>
                                            </h2>
                                            <div id="product_testing_note" class="accordion-collapse collapse" aria-labelledby="testing_note" data-bs-parent="#testing_note">
                                                <div class="accordion-body">
                                                    <div class="form-group{{ $errors->has('testing_note_'.$lng) ? 'has-error' : ''}}">
                                                        {!! Form::textarea('testing_note_'.$lng, isset($other_product) && isset($other_product->product_meta->testing_notes) ? $other_product->product_meta->testing_notes[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                                        {!! $errors->first('testing_note_'.$lng, '<p class="help-block">:message</p>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="accordion" id="product_detail">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="product_detail">
                                                <button class="accordion-button fs-6 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#product_product_detail" aria-expanded="true" aria-controls="product_product_detail" style="padding: 1.1rem 1rem;">
                                                    @foreach (config('locale.langs_code') as $key => $code)
                                                        @if ($lng == $key)
                                                            {{ __('backend.products.product_detail') }} ({{ $code }})
                                                        @endif
                                                    @endforeach
                                                </button>
                                            </h2>
                                            <div id="product_product_detail" class="accordion-collapse collapse" aria-labelledby="product_detail" data-bs-parent="#product_detail">
                                                <div class="accordion-body">
                                                    <div class="form-group{{ $errors->has('product_detail_'.$lng) ? 'has-error' : ''}}">
                                                        {!! Form::textarea('product_detail_'.$lng, isset($product) && isset($product->product_meta->product_details) ? $product->product_meta->product_details[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                                        {!! $errors->first('product_detail_'.$lng, '<p class="help-block">:message</p>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="accordion" id="award">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="award">
                                                <button class="accordion-button fs-6 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#product_award" aria-expanded="true" aria-controls="product_award" style="padding: 1.1rem 1rem;">
                                                    @foreach (config('locale.langs_code') as $key => $code)
                                                        @if ($lng == $key)
                                                            {{ __('backend.products.award') }} ({{ $code }})
                                                        @endif
                                                    @endforeach
                                                </button>
                                            </h2>
                                            <div id="product_award" class="accordion-collapse collapse" aria-labelledby="award" data-bs-parent="#award">
                                                <div class="accordion-body">
                                                    <div class="form-group{{ $errors->has('award_'.$lng) ? 'has-error' : ''}}">
                                                        {!! Form::textarea('award_'.$lng, isset($other_product) && isset($other_product->product_meta->awards) ? $other_product->product_meta->awards[$lng] : null, ('' == 'required') ? ['class' => 'form-control editor', 'required' => 'required'] : ['class' => 'form-control editor']) !!}
                                                        {!! $errors->first('award_'.$lng, '<p class="help-block">:message</p>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="accordion" id="product_seo">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="product_seo">
                                                <button class="accordion-button fs-6 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#product_product_seo" aria-expanded="true" aria-controls="product_product_seo" style="padding: 1.1rem 1rem;">
                                                    @foreach (config('locale.langs_code') as $key => $code)
                                                        @if ($lng == $key)
                                                            {{ __('backend.seo.search_engine_optimize') }} ({{ $code }})
                                                        @endif
                                                    @endforeach
                                                </button>
                                            </h2>
                                            <div id="product_product_seo" class="accordion-collapse collapse" aria-labelledby="product_seo" data-bs-parent="#product_seo">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="@if ($lng == 'en') col-md-6 @else col-md-12 @endif">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group{{ $errors->has('meta_title_'.$lng) ? 'has-error' : ''}}">
                                                                        {!! Form::label('meta_title_'.$lng, __('backend.seo.meta_title').'('.strtoupper($lng).')', ['class' => 'control-label mb-3']) !!}
                                                                        {!! Form::text('meta_title_'.$lng, isset($other_product) && isset($other_product->product_meta->meta_titles) ? $other_product->product_meta->meta_titles[$lng] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                                        {!! $errors->first('meta_title_'.$lng, '<p class="help-block">:message</p>') !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-4">
                                                                <div class="col-md-12">
                                                                    <div class="form-group{{ $errors->has('meta_description_'.$lng) ? 'has-error' : ''}}">
                                                                        {!! Form::label('meta_description_'.$lng, __('backend.seo.meta_description').'('.strtoupper($lng).')', ['class' => 'control-label mb-3']) !!}
                                                                        {!! Form::textarea('meta_description_'.$lng, isset($other_product) && isset($other_product->product_meta->meta_descriptions) ? $other_product->product_meta->meta_descriptions[$lng] : null, ('' == 'required') ? ['class' => 'form-control h-150px', 'required' => 'required'] : ['class' => 'form-control h-150px']) !!}
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
                                                                                    @if(!empty($other_product->product_meta->meta_image))
                                                                                        <div class='lfmimage-container meta-imagelfmc0'>
                                                                                            <img src="{{ asset($other_product->product_meta->meta_image) }}" class='lfmimage w-100' style="height: 20rem;">
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
                                                                                <input id="meta-image" class="form-control" type="text" name="meta_image" value="{{isset($other_product) && isset($other_product->product_meta) ? $other_product->product_meta->meta_image : ''}}">
                                                                            </div>  
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-4">
                                                                        <div class="col-md-12">
                                                                            {!! Form::label('meta_image_alt', 'Meta Image Alt', ['class' => 'control-label mb-3']) !!}
                                                                            {!! Form::text('meta_image_alt', isset($other_product) && isset($other_product->product_meta) ? $other_product->product_meta->meta_image_alt : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('code') ? 'has-error' : ''}}">
                            {!! Form::label('code', __('backend.products.product_code'), ['class' => 'control-label mb-3']) !!}
                            {!! Form::text('code', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('capacity') ? 'has-error' : ''}}">
                            {!! Form::label('capacity', __('backend.products.product_capacity'), ['class' => 'control-label mb-3']) !!}
                            {!! Form::text('capacity', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('capacity', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('recommendations') ? 'has-error' : ''}}">
                            {!! Form::label('recommendations', __('backend.products.recommendations'), ['class' => 'control-label mb-3']) !!}
                            {!! Form::select('recommendations[]', $recommendations, null, ['class' => 'form-select form-select-lg form-select', 'data-control' => 'select2', 'data-placeholder' =>  __('backend.products.select_products'), 'data-allow-clear' => 'true' , 'multiple' => 'multiple']) !!}
                            {!! $errors->first('recommendations', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header border-0">
                <div class="card-title">
                    {{ __('backend.products.price') }}
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('original_price') ? 'has-error' : ''}}">
                            {!! Form::label('original_price', __('backend.products.hong_kong_original_price'), ['class' => 'control-label mb-3']) !!}

                            <div class="from-group mb-3">
                                <div class="input-group mb-3">
                                    <div class="mw-100px">
                                        {!! Form::text('currency', 'HK$', ['class' => 'form-control form-control-solid input-group-text', 'readonly' => true ]) !!}
                                    </div>
                                    {!! Form::number('original_price', null, ('' == 'required') ? ['class' => 'form-control w-100', 'required' => 'required', 'step' => 'any'] : ['class' => 'form-control', 'step' => 'any']) !!}
                                </div>
                            </div>
                            {!! $errors->first('original_price', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('sale_price') ? 'has-error' : ''}}">
                            {!! Form::label('sale_price', __('backend.products.hong_kong_offer_price'), ['class' => 'control-label mb-3']) !!}
                            <div class="from-group mb-3">
                                <div class="input-group mb-3">
                                    <div class="mw-100px">
                                        {!! Form::text('currency', 'HK$', ['class' => 'form-control form-control-solid input-group-text', 'readonly' => true ]) !!}
                                        <input type="hidden" name="currency_type" value="HK$">
                                    </div>
                                    {!! Form::number('sale_price', null, ('' == 'required') ? ['class' => 'form-control w-100', 'required' => 'required', 'step' => 'any'] : ['class' => 'form-control', 'step' => 'any']) !!}
                                </div>
                            </div>
                            {!! $errors->first('sale_price', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="accordion" id="product_rating">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="product_rating">
                            <button class="accordion-button fs-6 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#product_product_rating" aria-expanded="true" aria-controls="product_product_rating" style="padding: 2.1rem 1rem;">
                                @foreach (config('locale.langs_code') as $key => $code)
                                    @if ($lng == $key)
                                    {{ __('backend.products.product_rating') }} ({{ $code }})
                                    @endif
                                @endforeach
                            </button>
                        </h2>
                        <div id="product_product_rating" class="accordion-collapse collapse" aria-labelledby="product_rating" data-bs-parent="#product_rating">
                            <div class="accordion-body">
                                <div class="row">
                                    <label for="Score Rp" class="fw-bold text-gray-600 fs-6 control-label mb-4">{{ __('backend.products.score_rp') }}</label>
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('score_rp') ? 'has-error' : ''}}">
                                            {!! Form::number('score_rp', isset($other_product) && isset($other_product->product_rating->score_rp) ? $other_product->product_rating->score_rp : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'min' => 0, 'pattern' => '[0-9]+'] : ['class' => 'form-control', 'min' => 0, 'pattern' => '[0-9]+']) !!}
                                            {!! $errors->first('score_rp', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label for="Score WS" class="fw-bold text-gray-600 fs-6 control-label mb-4">{{ __('backend.products.score_ws') }}</label>
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('score_ws') ? 'has-error' : ''}}">
                                            {!! Form::number('score_ws', isset($other_product) && isset($other_product->product_rating->score_ws) ? $other_product->product_rating->score_ws : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'min' => 0, 'pattern' => '[0-9]+'] : ['class' => 'form-control', 'min' => 0, 'pattern' => '[0-9]+']) !!}
                                            {!! $errors->first('score_ws', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label for="Score JH" class="fw-bold text-gray-600 fs-6 control-label mb-4">{{ __('backend.products.score_jh') }}</label>
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('score_jh') ? 'has-error' : ''}}">
                                            {!! Form::number('score_jh', isset($other_product) && isset($other_product->product_rating->score_jh) ? $other_product->product_rating->score_jh : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'min' => 0, 'pattern' => '[0-9]+'] : ['class' => 'form-control', 'min' => 0, 'pattern' => '[0-9]+']) !!}
                                            {!! $errors->first('score_jh', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label for="Score bc" class="fw-bold text-gray-600 fs-6 control-label mb-4">{{ __('backend.products.score_bc') }}</label>
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('score_bc') ? 'has-error' : ''}}">
                                            {!! Form::number('score_bc', isset($other_product) && isset($other_product->product_rating->score_bc) ? $other_product->product_rating->score_bc : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'min' => 0, 'pattern' => '[0-9]+'] : ['class' => 'form-control', 'min' => 0, 'pattern' => '[0-9]+']) !!}
                                            {!! $errors->first('score_bc', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label for="Score js" class="fw-bold text-gray-600 fs-6 control-label mb-4">{{ __('backend.products.score_js') }}</label>
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('score_js') ? 'has-error' : ''}}">
                                            {!! Form::number('score_js', isset($other_product) && isset($other_product->product_rating->score_js) ? $other_product->product_rating->score_js : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'min' => 0, 'pattern' => '[0-9]+'] : ['class' => 'form-control', 'min' => 0, 'pattern' => '[0-9]+']) !!}
                                            {!! $errors->first('score_js', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label for="Score BH" class="fw-bold text-gray-600 fs-6 control-label mb-4">{{ __('backend.products.score_bh') }}</label>
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('score_bh') ? 'has-error' : ''}}">
                                            {!! Form::number('score_bh', isset($other_product) && isset($other_product->product_rating->score_bh) ? $other_product->product_rating->score_bh : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'min' => 0, 'pattern' => '[0-9]+'] : ['class' => 'form-control', 'min' => 0, 'pattern' => '[0-9]+']) !!}
                                            {!! $errors->first('score_bh', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header border-0">
                <div class="card-title">
                    {{ __('backend.products.product_detail') }}
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-md-12">                            
                        <div id="showSimpleproduct" class="row mt-4 simple-product">
                            <div class="col-md-12">
                                <div class="card ps-0 pe-0" style="border: 1px solid #E4E6EF">
                                    <div class="card-header" style="min-height: 0px;padding:0px;">
                                        <ul class="nav nav-pills nav-fill">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#general" style="border-radius: 10px 10px 1px 1px; padding: 10px 35px 10px 35px;">{{ __('backend.products.general') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#inventory" style="border-radius: 10px 10px 1px 1px; padding: 10px 35px 10px 35px;">{{ __('backend.products.inventory') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="general" role="tabpanel">
                                                @include('admin.other-product._other_product_general_form')
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <button type="button" id="addAttribute" class="btn btn-primary"><i class="bi bi-plus-lg"></i>{{ __('backend.common.add_new') }}</button>                                                
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="inventory" role="tabpanel">
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <div class="form-group{{ $errors->has('min_stock_quantity') ? 'has-error' : ''}}">
                                                            <label for="sku" class="control-label mb-3">{{ __('backend.products.min_stock_quantity') }} <i class="bi bi-question-circle-fill"></i></label>
                                                            {!! Form::number('min_stock_quantity', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                            {!! $errors->first('min_stock_quantity', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <div class="form-group{{ $errors->has('quantity') ? 'has-error' : ''}}">
                                                            <label for="sku" class="control-label mb-3">{{ __('backend.products.stock_quantity') }} <i class="bi bi-question-circle-fill"></i></label>
                                                            {!! Form::number('quantity', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                            {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <div class="form-group{{ $errors->has('sell_quantity') ? 'has-error' : ''}}">
                                                            <label for="sku" class="control-label mb-3">{{ __('backend.products.sell_quantity') }} <i class="bi bi-question-circle-fill"></i></label>
                                                            {!! Form::number('sell_quantity', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                            {!! $errors->first('sell_quantity', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <div class="form-group{{ $errors->has('refill_quantity') ? 'has-error' : ''}}">
                                                            <label for="sku" class="control-label mb-3">{{ __('backend.products.auto_fill_quantity') }} <i class="bi bi-question-circle-fill"></i></label>
                                                            {!! Form::number('refill_quantity', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                            {!! $errors->first('refill_quantity', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        @include('admin.other-product._other_product_right_sidebar')
    </div>
</div>
@push('scripts')
    <script>
        $('#lfm-meta-image').filemanager('file');
        $('#lfm-feature-image').filemanager('file');
    </script>
@endpush