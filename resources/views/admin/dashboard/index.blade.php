@extends('admin.layouts.master')
@section('title', 'Dashboard')
@section('breadcrumb', 'Admin Dashboard')
@section('breadcrumb-info', 'Admin Dashboard')
@section('content')
<!--begin::Content-->

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl pb-4">
            <h2>Hi <span class="text-warning">Admin</span>, Welcome to Dashboard</h2>
            <!-- begin::modal -->
                <div class="adminStockModal modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog min-w-1000px" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Product List</h5>
                                <button type="button" class="adminCloseStockModal btn btn-icon btn-active-light-secondary btn btn-secondary w-30px h-30px">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            <div class="adminAddProductList modal-body h-300px scroll-y">
                                
                            </div>
                            <div class="modal-footer max-w-100px justify-content-start">
                                <div class="row w-100">
                                    <div id="stockWarning"></div>
                                    <div class="col-md-8">
                                        <input type="number" placeholder="Enter Refill Quantity" name="product_quantity" id="product-quantity" class="form-control">
                                    </div>
                                   <div class="col-md-4 text-end">
                                        <button type="button" class="adminApplyProduct btn btn-primary">Apply all products</button>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- begin::modal -->
            <!-- begin::modal -->
            <div class="adminQuantityModal modal" tabindex="-1" role="dialog">
                <div class="modal-dialog min-w-1000px" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Product List</h5>
                            <button type="button" class="adminCloseQuantityModal btn btn-icon btn-active-light-secondary btn btn-secondary w-30px h-30px">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                        <div class="adminProductList modal-body h-300px scroll-y">
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- begin::modal -->
            @if (isset($out_of_stock_product) && $out_of_stock_product > 0)
                <div class="row pb-4 pt-8">
                    <div class="col-xl-12">
                        <!--begin::Timeline details-->
                        <div class="overflow-auto pb-5">
                            <!--begin::Notice-->
                            <div class="notice d-flex rounded border-warning border border min-w-lg-600px flex-shrink-0 p-6" style="background-color:#FFF4DE">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                    <!--begin::Content-->
                                    <div class="mb-3 mb-md-0">
                                        <h4>Out of Stock of products</h4>
                                        {{-- <div class="fs-6 text-gray-700 pe-7 pb-4">Login into Admin Dashboard to make sure the data integrity is OK</div> --}}
                                        <button class="mt-4 btn btn-sm btn-warning adminCheckStock">View All</button>
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Action-->
                                    {{-- <a href="#" class="px-6 align-self-center text-nowrap"><i class="bi bi-x"></i>Dimiss</a> --}}
                                    <!--end::Action-->
                                </div>
                                <span class="top-0 start-0 translate-middle badge badge-circle badge-danger">{{ $out_of_stock_product }}</span>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Notice-->
                        </div>
                        <!--end::Timeline details-->
                    </div>
                </div>
            @endif

            @if (isset($sold_out_product) && $sold_out_product > 0)
                <div class="row pb-4">
                    <div class="col-xl-12">
                        <!--begin::Timeline details-->
                        <div class="overflow-auto pb-5">
                            <!--begin::Notice-->
                            <div class="notice d-flex rounded border-warning border border min-w-lg-600px flex-shrink-0 p-6" style="background-color:#FFF4DE">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                    <!--begin::Content-->
                                    <div class="mb-3 mb-md-0">
                                        <h4>Sold out products</h4>
                                        {{-- <div class="fs-6 text-gray-700 pe-7 pb-4">Login into Admin Dashboard to make sure the data integrity is OK</div> --}}
                                        <button class="mt-4 btn btn-sm btn-warning adminCheckQuantity">View All</button>
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Action-->
                                    {{-- <a href="#" class="px-6 align-self-center text-nowrap"><i class="bi bi-x"></i>Dimiss</a> --}}
                                    <!--end::Action-->
                                </div>
                                <span class="top-0 start-0 translate-middle badge badge-circle badge-danger">{{ $sold_out_product }}</span>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Notice-->
                        </div>
                        <!--end::Timeline details-->
                    </div>
                </div>
            @endif

            @include('admin.dashboard.analytics')

            <div class="row gy-5 g-xl-8">
                <div class="col-xl-3">
                    <div class="row g-4 g-xl-8">
                        <div class="col-xl-12">
                            <!--begin::Statistics Widget 4-->
                            <div class="card card-xl-stretch mb-5 mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body p-0">
                                    <div class="d-flex flex-stack card-p flex-grow-1">
                                        <span class="symbol symbol-50px me-2">
                                            <span class="symbol-label bg-light-success">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                                <span class="svg-icon svg-icon-2x svg-icon-success">
                                                    <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 24 24">
                                                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                        <div class="d-flex flex-column text-end">
                                            <span class="text-dark fw-bolder fs-2">2,322</span>
                                            <span class="text-muted fw-bold mt-1">Total Visitors</span>
                                        </div>
                                    </div>
                                    <div class="statistics-totalVisitor" data-kt-chart-color="primary" style="height: 150px;"></div>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Statistics Widget 4-->
                        </div>
                    </div>
                    <div class="row g-5 g-xl-8">
                        <div class="col-xl-12">
                            <!--begin::Statistics Widget 4-->
                            <div class="card card-xl-stretch mb-5 mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body p-0">
                                    <div class="d-flex flex-stack card-p flex-grow-1">
                                        <span class="symbol symbol-50px me-2">
                                            <span class="symbol-label bg-light-primary">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                                <span class="svg-icon svg-icon-2x svg-icon-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                        <div class="d-flex flex-column text-end">
                                            <span class="text-dark fw-bolder fs-2">6,580</span>
                                            <span class="text-muted fw-bold mt-1">Total Page Views</span>
                                        </div>
                                    </div>
                                    <div class="statistics-pageview-year card-rounded-bottom" data-kt-chart-color="primary" style="height: 150px"></div>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Statistics Widget 4-->
                        </div>
                    </div>
                </div>
               <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::Chart widget 3-->
                    <div class="card card-xl-stretch mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Sale This Month</span>
                            </h3>
                        </div>
                        <!--end::Header-->
                        <div class="card-toolbar px-6">
                            <ul class="nav" id="kt_chart_widget_11_tabs">
                                <li class="nav-item">
                                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bolder test1 px-4 me-1" data-bs-toggle="tab" id="kt_chart_widget_11_tab_1" href="#kt_chart_widget_11_tab_content_1">Year</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bolder test2 px-4 me-1 active" data-bs-toggle="tab" id="kt_chart_widget_11_tab_2" href="#kt_chart_widget_11_tab_content_2">Month</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bolder test3 px-4 me-1" data-bs-toggle="tab" id="kt_chart_widget_11_tab_3" href="#kt_chart_widget_11_tab_content_3">Week</a>
                                </li>
                            </ul>
                        </div>
                        <!--begin::Card body-->
                        <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
                            <!--begin::Chart-->
                            <div id="kt_charts_widget_4" class="min-h-auto ps-4 pe-6" style="height: 400px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Chart widget 3-->
                </div>
                <!--end::Col-->
                <div class="col-xl-3">
                    <div class="card card-xl-stretch mb-xl-8">
                        <!--begin::Beader-->
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Devices used to access the site</span>
                                <span class="text-muted fw-bold mt-1">322 Total Visitors</span>
                            </h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column">
                            <div class="flex-grow-1"  >
                                <div id="device_category" data-kt-chart-color="success" style="height: 200px"></div>
                            </div>
                            
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-xl-12 pb-4">
                    <div class="mb-1 float-left">
                        <!--begin::Link-->
                        <a class="btn btn-sm btn-primary me-2" href="../../demo1/dist/apps/ecommerce/sales/listing.html">Whole Sale</a>
                        <!--end::Link-->
                        <!--begin::Link-->
                        <a class="btn btn-sm btn-secondary me-2" href="../../demo1/dist/apps/ecommerce/catalog/add-product.html">Retail</a>
                        <!--end::Link-->
                    </div>
                </div>
            </div> --}}
            <div class="row gy-5 g-xl-8 pb-8">
                <div class="col-xl-3">
                    <!--begin::Card widget 5-->
                    <div class="card card-flush">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Amount-->
                                    <span class="fs-2 fw-bolder text-muted me-2 lh-1 ls-n2">This month Sale</span>
                                    <!--end::Amount-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end pt-0">
                            <!--begin::Progress-->
                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                    <span class="fw-boldest fs-6 text-dark">HK$ 0.00</span>
                                </div>
                                <div class="h-8px mx-3 w-100 rounded" style="background-color:#FEE7DD;">
                                    <div class="rounded h-8px" role="progressbar" style="width: 62%; background-color:#EF6327;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 5-->
                </div>
                <div class="col-xl-3">
                    <!--begin::Card widget 5-->
                    <div class="card card-flush">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Amount-->
                                    <span class="fs-2 fw-bolder text-muted me-2 lh-1 ls-n2">This month new order</span>
                                    <!--end::Amount-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end pt-0">
                            <!--begin::Progress-->
                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                    <span class="fw-boldest fs-6 text-dark">0</span>
                                </div>
                                <div class="h-8px mx-3 w-100 bg-light-warning rounded">
                                    <div class="rounded h-8px" role="progressbar" style="width: 62%;background-color:#FFA800;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 5-->
                </div>
                <div class="col-xl-3">
                    <!--begin::Card widget 5-->
                    <div class="card card-flush">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Amount-->
                                    <span class="fs-2 fw-bolder text-muted me-2 lh-1 ls-n2">This month new customer</span>
                                    <!--end::Amount-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end pt-0">
                            <!--begin::Progress-->
                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                    <span class="fw-boldest fs-6 text-dark">0</span>
                                </div>
                                <div class="h-8px mx-3 w-100 bg-light-success rounded">
                                    <div class="rounded h-8px" role="progressbar" style="width: 62%; background-color:#0BB783;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 5-->
                </div>
                <div class="col-xl-3">
                    <!--begin::Card widget 5-->
                    <div class="card card-flush">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Amount-->
                                    <span class="fs-2 fw-bolder text-muted me-2 lh-1 ls-n2">Low stock product</span>
                                    <!--end::Amount-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end pt-0">
                            <!--begin::Progress-->
                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                    <span class="fw-boldest fs-6 text-dark">481</span>
                                </div>
                                <div class="h-8px mx-3 w-100 rounded" style="background-color:#EEE5FF;">
                                    <div class="rounded h-8px" role="progressbar" style="width: 62%; background-color:#8950FC;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 5-->
                </div>
            </div>
            
            <x-backend.order-dashboard />  <!-- latest order -->

            <x-backend.top-best-seller-dashboard />  <!-- popular products -->

            <x-backend.popular-search-coupon />  <!-- popular search and coupon -->
                
        </div>
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@endsection
@push('scripts')
<script src="{{ asset('backend/js/admin-dashboard.js') }}"></script>
@endpush