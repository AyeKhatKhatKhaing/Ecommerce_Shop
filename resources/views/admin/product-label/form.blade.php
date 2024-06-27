<div class="row">
    <div class="col-md-12">
        <h2 class="fs-1">@if($formMode == "edit") {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.product_label') }}</h2>
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
                                <div class="form-group{{ $errors->has('name_'.$lng) ? 'has-error' : ''}}">
                                    @foreach (config('locale.langs_code') as $key => $code)
                                        @if ($lng == $key)
                                            {!! Form::label('name_'.$lng, __('backend.product_label.name').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                        @endif
                                    @endforeach
                                    {!! Form::text('name_'.$lng, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                    {!! $errors->first('name_'.$lng, '<p class="text-danger">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row mt-7">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="form-group">
                        <div class="float-left">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                                {{ __('backend.common.save') }}</button>
                            <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('/admin/product-label') }}'"><i class="bi bi-x"
                                    aria-hidden="true"></i> {{ __('backend.common.cancel') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
