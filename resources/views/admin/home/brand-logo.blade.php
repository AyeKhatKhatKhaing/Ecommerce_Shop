<div class="accordion" id="accordionExample{{ $index }}">
    <div class="accordion-item mb-5">
        <h2 class="accordion-header">
            <button class="accordion-button fs-6 fw-bold collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse{{ $index }}" aria-expanded="true"
                aria-controls="collapse{{ $index }}" style="padding: 1.1rem 1rem;">
                {{ __('backend.home.brand_logo') }}
            </button>
        </h2>
        <div id="collapse{{ $index }}" class="accordion-collapse collapse"
            data-bs-parent="#accordionExample{{ $index }}">
            <div class="accordion-body">
                <div class="card mt-4 rows ">
                    <div class="card-body" style="background-color: #fff9f5">
                        <div class="brand-logo d-flex p-3 justify-content-between mt-2 align-items-start gap-3 ">
                            <div class="rounded p-3 w-100">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="card mb-5" style="margin-top: 27px">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <span class="my-4" style="width:36px;">
                                                            <h5>{{ __('backend.home.link') }}</h5>
                                                        </span>
                                                        <div class="form-group w-100">
                                                            <input type="text" class="form-control"
                                                                name="brand_url[]"
                                                                value="{{ isset($detail['url']) ? $detail['url'] : '' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="hidden" data-id="{{ $index }}" class="indices"
                                                name="brand_indices[]" value="{{ $index }}" id="indices">
                                            <div class="w-100">
                                                <h4>{{ __('backend.common.image') }}</h4>
                                                <div class="card mb-5 p-2">
                                                    <div class="form-group text-center brand-logo">
                                                        <div id="holder-brand{{ $index }}-image">
                                                            @if (!empty($detail['image']))
                                                                <div
                                                                    class='lfmimage-container-sm brand{{ $index }}-imagelfmc0'>
                                                                    <img src="{{ isset($detail['image']) ? asset($detail['image']) : '' }}"
                                                                        class='lfmimage-sm w-100 '>
                                                                    <button type="button" onclick="removeImage('brand{{ $index }}-image',0)" class="btn btn-icon btn-active-light-danger btn btn-danger w-30px h-30px remove-image w-100" style="position: absolute; top: 10px; right: 10px;">
                                                                        <i class='bi bi-trash'></i>
                                                                    </button>
                                                                </div>
                                                            @else
                                                                <img src="{{ asset('backend/media/remfly/images/blank-image.svg') }}"
                                                                    class="img-thumbnail-sm">
                                                            @endif
                                                        </div>
                                                        <div class="input-group input-group-sm mt-3 mx-auto">
                                                            <span class="input-group-btn">
                                                                <a id="lfm-brand{{ $index }}-image"
                                                                    data-input="brand{{ $index }}-image"
                                                                    data-preview="holder-brand{{ $index }}-image"
                                                                    class="btn btn-primary text-white lfm">
                                                                    <i class="bi bi-image-fill"></i>
                                                                </a>
                                                            </span>
                                                            <input id="brand{{ $index }}-image"
                                                                class="form-control" type="text"
                                                                name="brand_image[]"
                                                                value="{{ isset($detail['image']) ? $detail['image'] : '' }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-md-12">
                                                            {!! Form::label('brand_image_alt', 'Image Alt', ['class' => 'control-label mb-3']) !!}
                                                            {!! Form::text('brand_image_alt[]', isset($detail['image_alt']) ? $detail['image_alt'] : null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                                            {!! $errors->first('brand_image_alt', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            @if ($index !== 0)
                                <button id="removeBrandLogo" type="button"
                                    class="removeBrandLogo{{ $index }} btn btn-danger btn-sm d-flex justify-content-center align-items-center"
                                    style="width:30px;height:30px">-</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
