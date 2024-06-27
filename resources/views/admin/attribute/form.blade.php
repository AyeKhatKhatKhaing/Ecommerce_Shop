<div class="row">
    <div class="col-md-12">
        <h2 class="fs-1">@if($formMode == "edit") {{ __('backend.common.edit') }} @else {{ __('backend.common.create') }} @endif {{ __('backend.sidebar.attributes') }}</h2>
    </div>
</div>
<div class="row mt-7">
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
                    @foreach (config('locale.langs') as $lngcode => $lng)
                        <div class="tab-pane fade {{ $lngcode == 'en' ? 'active show' : '' }}" id="{{$lngcode}}" role="tabpanel">
                            <div class="col-md-12">
                                <!-- start attribute term and value text box -->
                                <div class="row">
                                    <div class="col-md-12">    
                                        <div class="form-group{{ $errors->has('name_'.$lng) ? 'has-error' : ''}}">
                                            @foreach (config('locale.langs_code') as $key => $code)
                                                @if ($lngcode == $key)
                                                    {!! Form::label('attribute_term_'.$lng,  __('backend.attributes.attribute_term').'('.$code.')', ['class' => 'control-label mb-3 required']) !!}
                                                @endif
                                            @endforeach
                                            {!! Form::text('name_'.$lngcode, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                            {!! $errors->first('name_'.$lngcode, '<p class="text-danger">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-4 mb-3 form-group{{ $errors->has('name') ? 'has-error' : ''}}">
                        {!! Form::label('name', __('backend.attributes.attribute_values'), ['class' => 'from-label mb-3 required']) !!}
                        <div id="inputAttributeFormRow">
                            @if(isset($attribute_term) && $attribute_term->attributes->count() > 0)
                                @foreach ($attribute_term->attributes as $item)
                                    <div class="input-group mb-3">
                                        {!! Form::text('values['.$item->id.']', $item->name , ('required' == 'required') ? ['class' => 'form-control'] : ['class' => 'form-control']) !!}
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-3">
                                    {!! Form::text('values[]', null, ('required' == 'required') ? ['class' => 'form-control'] : ['class' => 'form-control']) !!}
                                </div>
                            @endif
                        </div>
                        <div id="newAttributeRow"></div>
                        @php
                            $values = 'values.*';
                        @endphp
                        {!! $errors->first($values, '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-sm" id="addAttributeRow" type="button"><i class="fas fa-plus"></i> {{ __('backend.common.add_new') }}</button>
                    </div>
                    <!-- attribute term and value text box -->
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
                            <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('/admin/product-attribute') }}'"><i class="bi bi-x"
                                    aria-hidden="true"></i> {{ __('backend.common.cancel') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(() => {
        $('#addAttributeRow').on('click', function() {
            var html  = '';
            html     += '<div id="inputAttributeFormRow">';
            html     += '<div class="input-group mb-3">';
            html     += '<input type="text" name="values[]" class="form-control m-input" autocomplete="off">';
            html     += '<span id="removeAttributeRow" class="btn-danger input-group-text" id="basic-addon2"><i class="fas fa-trash fs-4" style="color: #ffffff"></i></span>';
            html     += '</div>';

            $('#newAttributeRow').append(html);
        })
    })

    $(document).on('click', '#removeAttributeRow', function() {

        $(this).closest('#inputAttributeFormRow').remove();
    })
</script>

@endpush
