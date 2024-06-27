<div class="row mt-4">
    <div class="col-md-12">
        <label for="" class="control-label mb-3">{{ __('backend.products.product_attributes') }}</label>
        @if (isset($product))
            @php
                $product_attributes = $product->attributes->count() > 0 ? $product->attributes : null;
            @endphp
        @endif
        @if (isset($product_attributes))
            @foreach ($product_attributes as $attribute)
                <div class="row mt-4" id="inputFormRow">
                    <div class="col-md-5">
                        <select name="simple_attribute_names[]" id="#product-attribute-edit-value-{{ $attribute->id }}" class="form-select product-attribute-name"  data-control="select2" data-hide-search="true" data-placeholder="{{ __('backend.products.choose_attributes') }}">
                            <option></option>
                            @foreach ($attribute_terms as $item)
                                <option value="{{ $item->id }}" @if($attribute->attribute_term_id == $item->id) selected @endif>{{ $item->name_en }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        @php
                            $attribute_value = $attribute_terms->where('id', $attribute->attribute_term_id)->first();
                        @endphp
                        <select name="simple_attribute_values[]" id="product-attribute-edit-value-{{ $attribute->id }}" class="form-select product-attribute-value" id="product-attribute-value" data-control="select2" data-hide-search="true" data-placeholder="{{ __('backend.products.choose_value') }}">
                            <option></option>
                            @if (isset($attribute_value) && $attribute_value->attributes->count() > 0)
                                @foreach ($attribute_value->attributes as $value)
                                    <option value="{{ $value->id }}" @if($attribute->id == $value->id) selected @endif>{{ $value->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" id="deleteProductAttributeRow" class="btn-icon btn btn-danger w-100px"><i class="bi bi-trash-fill me-2"></i>{{ __('backend.products.delete') }}</button>
                    </div>
                </div>
            @endforeach
        @else
            <div class="row">
                <div class="col-md-5">
                    <select name="simple_attribute_names[]" id="#product-attribute-value" class="form-select product-attribute-name"  data-control="select2" data-hide-search="true" data-placeholder="{{ __('backend.products.choose_attributes') }}">
                        <option></option>
                        @foreach ($attribute_terms as $item)   
                            <option value="{{ $item->id }}">{{ $item->name_en }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <select name="simple_attribute_values[]" class="form-select product-attribute-value" id="product-attribute-value" data-control="select2" data-hide-search="true" data-placeholder="{{ __('backend.products.choose_value') }}">
                    </select>
                </div>
            </div>
        @endif
        <div id="getAttribute"></div>
    </div>
</div>
@push('scripts')
    <script>
        var attributes = {{ Illuminate\Support\Js::from($attribute_terms) }};

        function initSelect2() {
            $('.product-attribute-name').select2({
                placeholder: "{{__('Select Attribute')}}",
                minimumResultsForSearch: -1
            });
            $('.product-attribute-value').select2({
                placeholder: "{{__('Select Value')}}",
                minimumResultsForSearch: -1
            });
        }

        $(document).ready(() => {
            localStorage.removeItem('attribute_row');
            initSelect2();
            $('#addAttribute').on('click', function() {
                var attribute_row = localStorage.getItem('attribute_row');
                    attribute_row++;

                localStorage.setItem('attribute_row', attribute_row);

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.product.get.attribute') }}",
                    data: {"_token": "{{ csrf_token() }}",
                            class_name: "simple",
                            attribute_row: attribute_row,
                    },
                    datatype: 'json',
                    success: function (json) {
                        $("#getAttribute").append(json);
                        initSelect2();
                        var term_name = "#simple-attribute-name-"+attribute_row;
                        appendAttributeTerm(term_name);
                    }
                });
            })
        })

        $(document).on('click', '#deleteProductAttributeRow', function() {
            $(this).closest('#inputProductAttributeRow').remove();
        })
    </script>
    <script>
        $('.product-attribute-name').on('change', function() {
            var attribute_id  = $(this).val();
            var value_edit_id = $(this).attr('id');

            var attribute = attributes.find((x) => x.id == attribute_id);

            const count   = checkSelectedTerm(attribute_id);

            $(value_edit_id).find('option').remove();

            if(count > 1) {
                $(this).val(null);
                $(value_edit_id).find('option').remove();
            } else {
                $.each(attribute.attributes, function(key, value) {   
                    $(value_edit_id)
                        .append($("<option></option>")
                        .attr("value", value.id)
                        .text(value.name)); 
                });
            }
        });

        function changeAttribute(e) {
            var valueRow = e.attributes.valueRow.value;
            var attribute_id = e.value;
            
            const count = checkSelectedTerm(attribute_id);

            $(valueRow).find('option').remove();

            if(count > 1) {
                $('#'+ e.id + ' option:selected').remove();
            } else {
                var attribute = attributes.find((x) => x.id == attribute_id);

                $.each(attribute.attributes, function(key, value) {   
                    $(valueRow)
                        .append($("<option></option>")
                        .attr("value", value.id)
                        .text(value.name)); 
                });
            }
        }

        function appendAttributeTerm(term_name) {
            var selected_attributes = selectedAttributes();
            var arr_val = [];
            $.each(attributes, function(key, value) {   
                let index = selected_attributes.indexOf(value.id);
                    $(term_name)
                    .append($("<option></option>")
                    .attr("value", value.id)
                    .text(value.name_en));
            });
        }

        function selectedAttributes() {
            var  selected_attributes = $("select[name=\'simple_attribute_names[]\']").map(function() {
                            return parseInt($(this).val());
                        }).toArray();
            return selected_attributes;
        }

        function checkSelectedTerm(attribute_id) {
            var selected_attributes = selectedAttributes();

            var count = 0;

            selected_attributes.forEach( e => {
                if(e == parseInt(attribute_id)) {
                    count += 1;
                }
            })

            if(count > 1) {
                Swal.fire({
                        text: "Attribute term must be a unique.!",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then((result) => {
                        if(result.isConfirmed){
                            
                        }
                    });    
            }
            return count;
        }
    </script>
@endpush