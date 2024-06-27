<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ __('backend.products.feature_image') }}</h3>
    </div>
    <div class="card-body">
        <div class="list-title mb-3">
            <label for="kt_ecommerce_add_product_store_template" class="form-label">
                <span style="color: #B5B5C3">{{ __('backend.common.image_size') }} (427px x 258px)</span>
            </label>
        </div>
        <div class="panel-block">
            <div class="form-group">
               <div id="holder-feature-image">
                    @if(!empty($product->feature_image))
                        <div class='lfmimage-container feature-imagelfmc0'>
                            <img src="{{ isset($product->feature_image) ? asset($product->feature_image) : asset(old('feature_image')) }}" class='lfmimage w-100' style="height: 20rem;">
                            <div>
                                <button type="button" onclick="removeImage('feature-image',0)" class="btn btn-icon btn-active-light-danger btn btn-danger w-40px h-40px remove-image w-100" style="position: absolute; top: 150px; right: 50px;">
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
                        <a id="lfm-feature-image" data-input="feature-image" data-preview="holder-feature-image" class="btn btn-primary text-white">
                            <i class="bi bi-image-fill"></i>{{ __('backend.common.choose') }}
                        </a>
                    </span>
                    <input id="feature-image" class="form-control" type="text" name="feature_image" value="{{isset($product) ? $product->feature_image : old('feature_image')}}">
               </div>
               {!! $errors->first('feature_image', '<p class="help-block">:message</p>') !!}
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
<div class="card mt-4">
    <div class="card-body">
        <div class="panel-block">
            <h5>{{ __('backend.products.sorting') }}</h5>
            <input type="number" name="sort" value="{{ isset($product) && $product->sort ? $product->sort : '' }}" class="form-control">
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <div class="d-flex justify-content-between nopadding">
            <label for="is_cross_sell" class="control-label fs-4 fw-bold">{{ __('backend.products.is_cross_sell') }}</label>
            <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_cross_sell" id="is_cross_sell" {{ isset($product) && $product->is_cross_sell == 1 ? 'checked' : '' }}>
            </div>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-body">
        <div class="d-flex justify-content-between nopadding">
            <label for="is_exclusive" class="control-label fs-4 fw-bold">{{ __('backend.products.is_exclusive') }}</label>
            <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_exclusive" id="is_exclusive" {{ isset($product) && $product->is_exclusive == 1 ? 'checked' : '' }}>
            </div>
        </div>
    </div>
</div>
<div class="accordion mt-4" id="product-categories">
    <div class="accordion-item">
        <h2 class="accordion-header" id="categories_header">
            <button class="accordion-button fs-4 fw-bold min-h-75px {{ (isset($category_array) && $category_array != [] || $errors->has('category') || is_array(old('categories')) ) ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#product_categories" aria-expanded="{{ (isset($category_array) || $errors->has('category')) > 0 ? 'ture' : 'false' }}">
                {{ __('backend.products.product_categories') }}
            </button>
        </h2>
        <div id="product_categories" class="accordion-collapse collapse {{ (isset($category_array) && $category_array != [] || $errors->has('category') || is_array(old('categories')) ) ? 'show' : '' }}" aria-labelledby="categories_header" data-bs-parent="#product-categories">
            <div class="accordion-body row">
                @foreach ($categories as $category)
                    <div class="col-md-6">
                        {{-- <h4 class="text-muted">{{ $category->name_en }}</h4> --}}
                        <div class="overflow p-3">
                            {{-- @foreach ($category->subcategories as $item) --}}
                                <div class="form-check form-check-custom form-check-solid mb-5">
                                    <input class="form-check-input" name="categories[]" type="checkbox" value="{{ $category->id }}" id="{{ $category->name_hant }}" {{ (is_array(old('categories')) && in_array($category->id, old('categories'))) ? ' checked' : '' }} {{ isset($category_array) && in_array($category->id, $category_array) ? 'checked' : ''}}/>
                                    <label class="form-check-label" for="{{ $category->name_hant }}">
                                        {{ $category->name_hant }}
                                    </label>
                                </div>
                            {{-- @endforeach --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="accordion mt-4" id="product-country">
    <div class="accordion-item">
        <h2 class="accordion-header" id="country_header">
            <button class="accordion-button fs-4 fw-bold min-h-75px {{ (isset($product) && isset($product->country_id) || $errors->has('country_id') || is_array(old('country_id')) ) ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#product_country" aria-expanded="false">
                {{ __('backend.products.country') }}
            </button>
        </h2>
        <div id="product_country" class="accordion-collapse collapse {{ (isset($product) && isset($product->country_id) || $errors->has('country_id') || is_array(old('country_id')) ) ? 'show' : '' }}" aria-labelledby="country_header" data-bs-parent="#product-country">
            <div class="accordion-body">
                <select class="form-select" name="country_id" id="country-id" data-control="select2" data-hide-search="true" placeholder="Please Select Country" data-placeholder="Please Select Country" data-allow-clear="true">
                    <option></option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" {{ isset($product) && $product->country_id == $country->id ? 'selected' : '' }}>{{ $country->name_en }}</option>
                    @endforeach
                </select>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <select class="form-select" name="region_id" id="region-id" data-control="select2" data-hide-search="true" placeholder="Please Select Region" data-placeholder="Please Select Region" data-allow-clear="true">
                            @if (isset($region_list) && count($region_list) > 0 && $product->region_id)
                                @foreach ($region_list as $region)
                                    <option value="{{ $region->id }}" {{ isset($product) && $product->region_id == $region->id ? 'selected' : '' }}>{{ $region->name_en }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="accordion mt-4" id="product-promotion">
    <div class="accordion-item">
        <h2 class="accordion-header" id="promotion_header">
            <button class="accordion-button fs-4 fw-bold min-h-75px {{ (isset($promotion_array) && $promotion_array || $errors->has('promotions') || is_array(old('promotions')) ) ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#product_promotion" aria-expanded="false">
                {{ __('backend.products.promotion') }}
            </button>
        </h2>
        <div id="product_promotion" class="accordion-collapse collapse {{ (isset($promotion_array) && $promotion_array != [] || $errors->has('promotions') || is_array(old('promotions')) ) ? 'show' : '' }}" aria-labelledby="promotion_header" data-bs-parent="#product-promotion">
            <div class="accordion-body">
                <div class="row">
                    @foreach ($promotions as $promotion)
                        <div class="col-md-6">
                            <div class="overflow p-3">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" name="promotions[]" type="checkbox" value="{{ $promotion->id }}" {{ (is_array(old('promotions')) && in_array($promotion->id, old('promotions'))) ? ' checked' : '' }} {{ isset($promotion_array) && in_array($promotion->id, $promotion_array) ? 'checked' : ''}}/>
                                    <label class="form-check-label" for="{{ $promotion->name_hant }}">
                                        {{ $promotion->name_hant }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="accordion mt-4" id="product-offer-promotion">
    <div class="accordion-item">
        <h2 class="accordion-header" id="offer_promotion_header">
            <button class="accordion-button fs-4 fw-bold min-h-75px {{ (isset($product->offer_promotion_id) || $errors->has('offer_promotion_id')) ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#product_offer_promotion" aria-expanded="false">
                {{ __('backend.products.offer_promotion') }}
            </button>
        </h2>
        <div id="product_offer_promotion" class="accordion-collapse collapse {{ (isset($product->offer_promotion_id) || $errors->has('offer_promotion_id')) ? 'show' : '' }}" aria-labelledby="offer_promotion_header" data-bs-parent="#product-offer-promotion">
            <div class="accordion-body">
                <div class="row">
                    @foreach($offer_promotions as $offer_promotion)
                        <div class="col-md-12">
                            <div class="overflow p-3">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" name="offer_promotion_id" type="radio" value="{{ $offer_promotion->id }}" {{ isset($product) && $product->offer_promotion_id == $offer_promotion->id ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="{{ $offer_promotion->name_en }}">
                                        {{ $offer_promotion->name_en }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="accordion mt-4" id="product-label">
    <div class="accordion-item">
        <h2 class="accordion-header" id="label_header">
            <button class="accordion-button fs-4 fw-bold min-h-75px {{ (isset($product->label_id) || $errors->has('label_id')) ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#product_label" aria-expanded="false">
                {{ __('backend.products.product_label') }}
            </button>
        </h2>
        <div id="product_label" class="accordion-collapse collapse {{ (isset($product->label_id) || $errors->has('label_id')) ? 'show' : '' }}" aria-labelledby="label_header" data-bs-parent="#product-label">
            <div class="accordion-body">
                <div class="row">
                    @foreach($product_labels as $product_label)
                        <div class="col-md-12">
                            <div class="overflow p-3">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" name="label_id" type="radio" value="{{ $product_label->id }}" {{ isset($product) && $product->label_id == $product_label->id ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="{{ $product_label->name_en }}">
                                        {{ $product_label->name_en }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="accordion mt-4" id="product-classification">
    <div class="accordion-item">
        <h2 class="accordion-header" id="classification_header">
            <button class="accordion-button fs-4 fw-bold min-h-75px {{ (isset($classification_array) && $classification_array != [] || $errors->has('classifications') || is_array(old('classifications')) ) ? '' : 'collapsed'  }}" type="button" data-bs-toggle="collapse" data-bs-target="#product_classification" aria-expanded="false">
                {{ __('backend.products.classificatoin') }}
            </button>
        </h2>
        <div id="product_classification" class="accordion-collapse collapse {{ (isset($classification_array) && $classification_array != [] || $errors->has('classifications') || is_array(old('classifications')) ) ? 'show' : ''  }}" aria-labelledby="classification_header" data-bs-parent="#product-classification">
            <div class="accordion-body">
                <div class="row">
                    @foreach ($classifications as $classification)
                        <div class="col-md-6">
                            <div class="overflow p-3">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" name="classifications[]" type="checkbox" value="{{ $classification->id }}" {{ (is_array(old('classifications')) && in_array($classification->id, old('classifications'))) ? ' checked' : '' }} {{ isset($classification_array) && in_array($classification->id, $classification_array) ? 'checked' : ''}}/>
                                    <label class="form-check-label" for="{{ $classification->name_en }}">
                                        {{ $classification->name_en }}
                                    </label>
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
        $(document).on('change', '#country-id', function() {
            var country_id   = $(this).val();

            $.ajax({
                    type: "POST",
                    url: "{{ route('admin.product.get.region.list') }}",
                    data: {"_token": "{{ csrf_token() }}",
                            country_id: country_id,
                    },
                    datatype: 'json',
                    success: function (json) {
                        $('#region-id').select2({minimumResultsForSearch: -1}).html(json);
                    }
                });
        })
    </script>
@endpush