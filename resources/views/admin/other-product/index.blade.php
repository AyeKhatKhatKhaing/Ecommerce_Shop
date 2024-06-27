@extends('admin.layouts.master')
@section('title', __('backend.other_product.other_product'))
@section('breadcrumb', __('backend.other_product.other_product'))
@section('breadcrumb-info', __('backend.other_product.other_product'))
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="get" action="{{ url('/admin/other-product') }}" id="other-product-form" class="filter-clear-form">
                    <div class="card-header border-0"> 
                        <h3 class="card-title">
                            {{ __('backend.other_product.other_product') }}
                        </h3>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end me-3" data-kt-customer-table-toolbar="base">
                                <button type="submit" class="btn btn-primary" name="export" value="export-btn" id="export-all">
                                    <i class="fas fa-file-export"></i> {{ __('backend.filter.export') }}
                                </button>
                            </div>
                            <a href="{{ url('/admin/other-product/create') }}" class="btn btn-primary " title="Add New User">
                                <i class="bi bi-plus-lg"></i> {{ __('backend.common.add_new') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-header border-0">
                        <div class="card-title filter-style">
                            <div class="filter-section d-flex align-items-center position-relative my-1 me-3">
                                <div class="input-group input-group">
                                    <input type="text" id="search" class="search-box form-control form-control-solid" aria-label="Sizing example input" name="search"
                                        placeholder="{{ __('backend.filter.search') }}" aria-describedby="inputGroup-sizing-sm" 
                                        @isset($keyword) value="{{ $keyword }}" @endisset style="background-color: #F3F6F9;">
                                        @if($keyword)<i class="bi bi-x" onclick="clearSearch()" style="position: absolute; top: 11px; right: 70px; font-size: 22px;"></i>@endif
                                    <button class="btn btn-sm btn-secondary input-group-text" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="filter-section">
                                <div class="card-toolbar mx-4">
                                    <label class="fs-7 me-3 fw-bold text-gray-600">{{ __('backend.filter.status') }}</label>
                                    <div class="d-flex justify-content-center min-w-150px">
                                        <select class="form-select form-select-solid" id="status" name="status" data-control="select2" data-hide-search="true" data-placeholder="{{ __('backend.product_report.stock') }}" data-kt-ecommerce-product-filter="product-status" data-allow-clear="true">
                                            <option></option>
                                            <option value="all" {{ Request::get('status') == 'all' ? 'selected' : '' }}>{{ __('backend.filter.all') }}</option>
                                            <option value="hk" {{ Request::get('status') == 'hk' ? 'selected' : '' }}>{{ __('backend.filter.hong_kong') }}</option>
                                            <option value="ma" {{ Request::get('status') == 'ma' ? 'selected' : '' }}>{{ __('backend.filter.macau') }}</option>
                                        </select>
                                    </div>
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
                                    <th class="min-w-250px">{{ __('backend.products.item_name') }}</th>
                                    <th class="min-w-150px">{{ __('backend.other_product.sort') }}</th>
                                    <th class="min-w-150px">{{ __('backend.products.categories') }}</th>
                                    <th class="min-w-100px">{{ __('backend.products.qty') }}</th>
                                    <th class="min-w-100px">{{ __('backend.products.stock') }}</th>
                                    <th class="min-w-100px">{{ __('backend.common.enable') }}</th>
                                    <th class="min-w-100px">{{ __('backend.products.status') }}</th>
                                    <th class="min-w-200px">{{ __('backend.other_product.sort') }}</th>
                                    <th class="sticky text-center min-w-100px">{{ __('backend.common.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="fw-bold text-gray-600">
                                @foreach($other_products as $item)
                                    <tr>
                                        <td style="padding-left: 10px;">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-50px">
                                                    <span class="symbol-label w-150px h-100px">
                                                        <img src="{{ asset($item->feature_image) }}" class="w-150px h-100px" alt="{{ $item->feature_image_alt }}">
                                                    </span>
                                                </div>
                                                <div class="ms-5">
                                                    <div>
                                                        {{ isset($item) && isset($item->name_hant) ? $item->name_hant : '' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($item->type == 'hk')
                                                Hong Kong
                                            @else
                                                Macau
                                            @endif
                                        </td>
                                        <td>{{ $item->getCategoriesName($item->categories) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->sell_quantity }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="switcher_checkbox_{{ $item->id }}"
                                                    type="checkbox" onclick="statusChange({{ $item->id }}, '/admin/other-product/status-change')"
                                                    name="status{{ $item->id }}"
                                                    {{ $item->status ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($item->product_status != 0)
                                                <a href="javascript:void(0)" class="click-status" data-id={{ $item->id }}><span class="badge badge-light-success">Available</span></a>
                                            @else
                                                <a href="javascript:void(0)" class="click-status" data-id={{ $item->id }}><span class="badge badge-light-danger">Out of Stock</span></a>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="number" id="sort_{{ $item->id }}" class="w-100px" name="sort" min="1" value="{{ $item->sort ? $item->sort : '' }}">
                                            <input type="hidden" id="get_sort_{{ $item->id }}" name="get_sort" value="{{ $item->sort ? $item->sort : '' }}" class="form-control"/>
                                            <button class="product-sort-btn btn btn-icon btn-active-light-info btn btn-info w-30px h-30px" data-id="{{ $item->id }}">
                                                <i class="fa fa-save ico"></i>
                                            </button>
                                        </td>
                                        <td class="sticky text-center">
                                            <a href="{{ url('/admin/other-product/' . $item->id . '/edit') }}" title="Edit Hong Kong Product">
                                                <button class="btn btn-icon btn-active-light-primary btn btn-primary w-30px h-30px"><i class="bi bi-pencil-square" aria-hidden="true"></i></button></a>
                                            <form method="POST" action="{{ url('/admin/other-product' . '/' . $item->id) }}" class="deleteForm" style="display: inline;">                
                                                <input name="_method" type="hidden" value="DELETE">
                                                <input name="_token" type="hidden" value="{{ csrf_token() }}">                    
                                                <button type="submit" class="btn btn-icon btn-active-light-danger btn btn-danger w-30px h-30px show_confirm_delete" title='Delete'><i class="bi bi-trash" aria-hidden="true"></i></button>              
                                            </form>
                                        </td>
                                    </tr>                                   
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                            {{ Admin::tableLength($other_products) }}
                        </div>
                        <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                            <div class="pagination-wrapper"> {!! $other_products->appends([
                                'type'    => 'hk',
                                'search'  => Request::get('search'),
                                'status'  => Request::get('status'),
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
        $(document).ready(function() {
            $('#search').on('keypress', function(e){
                if (e.keyCode == 13) {
                    $('#export-all').prop('disabled', true);
                    $('#other-product-form').submit();
                }
            });
                $('#status').on('change', function() {
                $('#other-product-form').submit();
            });
        });

        $('.product-sort-btn').click(function () {
            var product_id   = $(this).data('id');
            let sort_number  = $('#sort_'+product_id).val();
            let get_sort     = $('#get_sort_'+product_id).val();

            if (sort_number != '') {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.other.product.update.sorting') }}",
                    data: {"_token": "{{ csrf_token() }}",
                            product_id: product_id,
                            sort_number: sort_number,
                    },
                    success:function (data) {
                        toastr.success("產品排序更新成功");
                    }
                })
            }else {
                toastr.warning("請新增排序編號");
                $('#sort_'+product_id).val(get_sort);
            }
        })
    </script>
@endpush