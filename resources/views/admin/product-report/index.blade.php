@extends('admin.layouts.master')
@section('title', __('backend.sidebar.product_report'))
@section('breadcrumb', __('backend.sidebar.product_report'))
@section('breadcrumb-info', __('backend.sidebar.product_report'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="get" action="{{ url('/admin/product-report') }}" id="product-report-form">
                        <div class="card-header border-0"> 
                            <h3 class="card-title">
                                {{ __('backend.sidebar.product_report') }}
                            </h3>
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end me-3" data-kt-customer-table-toolbar="base">
                                    <button type="submit" class="btn btn-primary" name="export" value="export-btn" id="export-all">
                                        <i class="fas fa-file-export"></i> {{ __('backend.filter.export') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-header border-0">
                            <div class="card-title filter-style">
                                <div class="filter-section">
                                    <div class="card-toolbar mx-4">
                                        <label class="fs-7 me-3 fw-bold text-gray-600">{{ __('backend.product_report.min_price') }}</label>
                                        <div class="d-flex justify-content-center min-w-150px">
                                            <input type="text" value="{{ isset($min_price) ? $min_price : '' }}" class="form-control w-150px" name="min_price" id="min-price" placeholder="{{ __('backend.product_report.enter_min_price') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-section">
                                    <div class="card-toolbar mx-4">
                                        <label class="fs-7 me-3 fw-bold text-gray-600">{{ __('backend.product_report.max_price') }}</label>
                                        <div class="d-flex justify-content-center min-w-150px">
                                            <input type="text" value="{{ isset($max_price) ? $max_price : '' }}" class="form-control w-150px" name="max_price" id="max-price" placeholder="{{ __('backend.product_report.enter_max_price') }}">
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="filter-section">
                                    <div class="card-toolbar mx-4">
                                        <label class="fs-7 me-3 fw-bold text-gray-600">{{ __('backend.product_report.sku') }}</label>
                                        <div class="d-flex justify-content-center min-w-150px">
                                            <input type="text" value="{{ isset($sku) ? $sku : '' }}"class="form-control w-150px" name="sku" id="sku" placeholder="{{ __('backend.product_report.enter_sku') }}">
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="filter-section">
                                    <div class="card-toolbar mx-4">
                                        <label class="fs-7 me-3 fw-bold text-gray-600">{{ __('backend.filter.status') }}</label>
                                        <div class="d-flex justify-content-center min-w-150px">
                                            <select class="form-select" id="status" name="status" data-control="select2" data-hide-search="true" data-placeholder="{{ __('backend.product_report.stock') }}" data-kt-ecommerce-product-filter="status" data-allow-clear="true">
                                                <option></option>
                                                <option value="all" {{ Request::get('status') == 'all' ? 'selected' : '' }}>{{ __('backend.filter.all') }}</option>
                                                <option value="1" {{ Request::get('status') == '1' ? 'selected' : '' }}>{{ __('backend.product_report.available') }}</option>
                                                <option value="0" {{ Request::get('status') == '0' ? 'selected' : '' }}>{{ __('backend.product_report.out_of_stock') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-section">
                                    <div class="card-toolbar mx-4">
                                        <button type="submit" id="search" class="btn btn-primary">{{ __('backend.product_report.search') }}</button>
                                    </div>
                                </div>
                                <div class="filter-section">
                                    <div class="card-toolbar mx-4">
                                        <button type="button" id="clear-filter" class="btn btn-primary">{{ __('backend.product_report.clear') }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <x-table-display />
                            </div>
                        </div>
                    </form>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-bordered fs-6 gy-5 dataTable no-footer">
                                <thead>
                                    <tr class="text-start text-gray-600 fw-boldest fs-7 text-uppercase gs-0">
                                        <th class="w-50px" style="padding-left: 10px;">#</th>
                                        <th class="min-w-150px">{{ __('backend.product_report.code') }}</th>
                                        <th class="min-w-150px">{{ __('backend.product_report.product_name') }}</th>
                                        <th class="min-w-125px">{{ __('backend.product_report.vintage') }}</th>
                                        {{-- <th class="min-w-100px">{{ __('backend.product_report.sku') }}</th> --}}
                                        <th class="min-w-100px">{{ __('backend.product_report.stock') }}</th>
                                        <th class="min-w-150px">{{ __('backend.product_report.total_stock_quantity') }}</th>
                                        <th class="min-w-100px">{{ __('backend.product_report.product_type') }}</th>
                                        <th class="min-w-150px">{{ __('backend.product_report.regular_price') }}</th>
                                        <th class="min-w-150px">{{ __('backend.product_report.sale_price') }}</th>
                                        <th class="min-w-150px">{{ __('backend.product_report.total_price') }}</th>
                                        <th class="min-w-100px">{{ __('backend.product_report.total_order_stock') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold text-gray-600">
                                    @foreach($product_reports as $item)
                                        <tr>
                                            <td style="padding-left: 10px;">{{ $loop->iteration }}</td>
                                            <td>{{ $item->code }}</td>
                                            <td>{{ $item->name_hant }}</td>
                                            <td>
                                                @if (isset($item->attributes))
                                                    @foreach ($item->attributes as $attribute)
                                                        @if ($attribute->attribute_term_id == 1)
                                                            {{ $attribute->name }}
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            {{-- <td>{{ $item->sku }}</td> --}}
                                            <td>{{ $item->quantity }}</td>
                                            <td>
                                                @if ($item->quantity > 0)
                                                    In Stock
                                                @else
                                                    Out Of Stock
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->type == 'hk')
                                                    Hong Kong
                                                @else
                                                    Macau
                                                @endif
                                            </td>
                                            <td>{{ $item->original_price }}</td>
                                            <td>{{ $item->sale_price }}</td>
                                            <td>{{ $item->sale_price != 0 ? round($item->sale_price * $item->quantity, 2) : round($item->original_price * $item->quantity, 2) }}</td>      
                                            <td>{{ $item->ordered_count ?? 0 }}</td>                                     
                                        </tr>                                   
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row my-3">
                            <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                                {{ Admin::tableLength($product_reports) }}
                            </div>
                            <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                <div class="pagination-wrapper"> {!! $product_reports->appends([
                                    'status'  => Request::get('status'),
                                    'search'  => Request::get('search'),
                                    'page'    => Request::get('page'),
                                    'display' => Request::get('display'),
                                ])->links('pagination::bootstrap-4')->render() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#search').on('click', function(e){
            if (e.keyCode == 13) {
                $('#export-all').prop('disabled', true);
                $('#product-report-form').submit();
            }
        });

        $('#min-price').on('keypress', function(e){
            if (e.keyCode == 13) {
                $('#export-all').prop('disabled', true);
                $('#product-report-form').submit();
            }
        });

        $('#max-price').on('keypress', function(e){
            if (e.keyCode == 13) {
                $('#export-all').prop('disabled', true);
                $('#product-report-form').submit();
            }
        });

        $('#status').on('change', function() {
            $('#product-report-form').submit();
        });

        $('#display').on('change', function(){
            $('#product-report-form').submit();
        })

        $('#clear-filter').on('click', function () {
            window.location.href = "product-report";
        });
    });  
</script>
@endpush