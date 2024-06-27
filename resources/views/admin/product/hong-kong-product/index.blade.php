@extends('admin.layouts.master')
@section('title',__('backend.sidebar.products'))
@section('breadcrumb',__('backend.sidebar.products'))
@section('breadcrumb-info',__('backend.sidebar.products'))
@section('content')
    <div class="container">
        <div class="row mx-1">
            @if(session()->has('import_errors') || session('flash_message'))
                <x-import-errors />
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <!-- Modal -->
                    <div class="modal fade" id="productImport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('admin.product.import.excel', ['type' => 'hk']) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel" style="padding-left: 130px;">{{ __('backend.products.product_import_excel') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="align-items-center">
                                            <input type="file" name="file" id="product-import" required>
                                            {!! $errors->first('file', '<p class="help-block">:message</p>') !!}
                                            <a href="{{ route('admin.product.sample.excel') }}" class="btn btn-secondary btn-sm float-end"><i class="fas fa-upload"></i> {{ __('backend.products.generate_sample') }}</a>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('backend.products.close') }}</button>
                                        <button type="submit" class="btn btn-primary">{{ __('backend.filter.import') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end:Modal -->
                    <form method="get" action="{{ url('/admin/product?type=hk') }}" id="hong-kong-form" class="filter-clear-form">
                        <div class="card-header border-0"> 
                            <h3 class="card-title">
                                {{ __('backend.products.hong_kong_product') }}
                            </h3>
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end me-3" data-kt-customer-table-toolbar="base">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productImport">
                                        <i class="fas fa-upload"></i> {{ __('backend.filter.import') }}
                                    </button>
                                </div>
                                <div class="d-flex justify-content-end me-3" data-kt-customer-table-toolbar="base">
                                    <button type="submit" class="btn btn-primary" name="export" value="export-btn" id="export-all">
                                        <i class="fas fa-file-export"></i> {{ __('backend.filter.export') }}
                                    </button>
                                </div>
                                <a href="{{ url('/admin/product/create?type=hk') }}" class="btn btn-primary " title="Add New User">
                                    <i class="bi bi-plus-lg"></i> {{ __('backend.common.add_new') }}
                                </a>
                            </div>
                        </div>
                        <input type="hidden" name="type" value="hk">
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
                                            <select class="form-select form-select-solid" id="product-status" name="product_status" data-control="select2" data-hide-search="true" data-placeholder="{{ __('backend.product_report.stock') }}" data-kt-ecommerce-product-filter="product-status" data-allow-clear="true">
                                                <option></option>
                                                <option value="all" {{ Request::get('product_status') == 'all' ? 'selected' : '' }}>{{ __('backend.filter.all') }}</option>
                                                <option value="1" {{ Request::get('product_status') == '1' ? 'selected' : '' }}>{{ __('backend.product_report.available') }}</option>
                                                <option value="0" {{ Request::get('product_status') == '0' ? 'selected' : '' }}>{{ __('backend.product_report.out_of_stock') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-section">
                                    <label for="" style="font-size: 12px;">{{ __('backend.products.category') }}</label>
                                    <div class="card-toolbar mx-4">
                                        <div class="d-flex justify-content-center min-w-150px">
                                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" name="category_filter" id="category-filter" data-placeholder="{{ __('backend.products.category') }}" data-allow-clear="true">
                                                <option></option>
                                                <option value="all">{{ __('backend.filter.all') }}</option>
                                                @foreach ($categories as $category)
                                                     <option value="{{ $category->id }}" {{ Request::get('category_filter') == $category->id ? 'selected' : '' }}>{{ $category->name_hant }}</option>
                                                @endforeach
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
                                        <th class="min-w-150px">{{ __('backend.products.categories') }}</th>
                                        <th class="min-w-100px">{{ __('backend.products.qty') }}</th>
                                        <th class="min-w-100px">{{ __('backend.products.stock') }}</th>
                                        <th class="min-w-100px">{{ __('backend.common.enable') }}</th>
                                        <th class="min-w-100px">{{ __('backend.products.status') }}</th>
                                        <th class="min-w-200px">{{ __('backend.products.sorting') }}</th>
                                        <th class="min-w-100px">{{ __('backend.common.last_updated') }}</th>
                                        <th class="sticky text-center min-w-100px">{{ __('backend.common.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold text-gray-600">
                                    @foreach($products as $item)
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
                                            <td>{{ $item->getCategoriesName($item->categories) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->sell_quantity }}</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" id="switcher_checkbox_{{ $item->id }}"
                                                        type="checkbox" onclick="statusChange({{ $item->id }}, '/admin/product/status-change')"
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
                                                <input type="number" id="sortInput" style="width:100px" name="sort{{$item->id}}" min="1" value="{{ $item->sort}}" class="sortVal">
                                                <button type="button" class="btn btn-icon btn-active-light-info btn btn-info w-30px h-30px updatesort" data-sort={{$item->sort}} data-sort-id={{$item->id}}><i class="fa fa-save ico"></i></button>
                                                <div id="msgSort" style="color: blue" class="sorting"></div>
                                            </td>
                                            <td>
                                                <span class="fw-bolder text-gray-600">{{ $item->updateUser ? $item->updateUser->name : '' }}</span><br>
                                                <span class="text-muted">{{ $item->updated_at }}</span>
                                            </td>
                                            <td class="sticky text-center">
                                                <a href="{{ url('/admin/product/' . $item->id . '/edit?type=hk') }}" title="Edit Hong Kong Product">
                                                    <button class="btn btn-icon btn-active-light-primary btn btn-primary w-30px h-30px"><i class="bi bi-pencil-square" aria-hidden="true"></i></button></a>
                                                <form method="POST" action="{{ url('/admin/product' . '/' . $item->id) }}" class="deleteForm" style="display: inline;">                
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
                                {{ Admin::tableLength($products) }}
                            </div>
                            <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                <div class="pagination-wrapper"> {!! $products->appends([
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
                    $('#hong-kong-form').submit();
                }
            });

            $('#product-status').on('change', function() {
                $('#hong-kong-form').submit();
            });

            $('#category-filter').on('change', function() {
                $('#hong-kong-form').submit();
            });

            $('#display').on('change', function() {
                $('#hong-kong-form').submit();
            });

            $('.updatesort').click(function(){
                var sort_id = $(this).attr('data-sort-id');
                var sort = $("input[name=sort"+sort_id+"]").val();
                console.log('sort', sort);
                $.ajax({
                    type: 'post',
                    url: 'updateproductSort',
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                    data: { sort_id : sort_id, sort: sort},
                    success: function(data){
                        toastr.success("產品排序更新成功");
                    }
                })
            })
    });
    </script>
@endpush