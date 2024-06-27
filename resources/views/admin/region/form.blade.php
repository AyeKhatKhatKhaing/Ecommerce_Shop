<div class="row">
    <div class="col-md-8">
        <h2 class="fs-1">@if($formMode == "edit") {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.regions') }}</h2>
    </div>

</div>
<div class="row mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header" style="min-height: 0px;padding:0px;">
                <ul class="nav nav-pills nav-fill">
                    @foreach (config('locale.langs') as $lngcode => $lng)
                    <li class="nav-item">
                        <a class="nav-link {{ $lngcode == 'en' ? 'active' : '' }}" data-bs-toggle="tab" href="#{{$lngcode}}" style="border-radius: 10px 10px 1px 1px; padding: 10px 15px 10px 15px;">{{$lng}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('name', __('backend.regions.country'), ['class' => 'from-label mb-3 required']) !!}
                            {!! Form::select('country_id',$countries, null, ['class' => 'form-select', 'data-control' => 'select2', 'data-hide-search' => "true", 'data-placeholder' => "Select Country"]) !!}
                            {!! $errors->first('country_id', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    @foreach (config('locale.langs') as $lngcode => $lng)
                        <div class="tab-pane fade {{ $lngcode == 'en' ? 'active show' : '' }}" id="{{$lngcode}}" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    @foreach (config('locale.langs_code') as $key => $code)
                                        @if ($lngcode == $key)
                                            {!! Form::label('name_'.$lngcode, __('backend.regions.name').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                        @endif
                                    @endforeach
                                    {!! Form::text('name_'.$lngcode, null, ('required' == 'required') ? ['class' => 'form-control'] : ['class' => 'form-control']) !!}
                                    {!! $errors->first('name_'. $lngcode, '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>