@extends('admin.layouts.master')
@section('title', __('backend.sidebar.order_report'))
@section('breadcrumb', __('backend.sidebar.order_report'))
@section('breadcrumb-info', __('backend.sidebar.order_report'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="get" action="{{ url('/admin/order-report') }}" id="order-report-form" class="filter-clear-form">
                        <div class="card-header border-0"> 
                            <h3 class="card-title">
                                {{ __('backend.sidebar.order_report') }}
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
                                        <label class="fs-7 me-3 fw-bold text-gray-600">{{ __('backend.filter.enter_from_date') }}</label>
                                        <div class="d-flex justify-content-center min-w-150px">
                                            <input type="text" value="{{ isset($from_date) ? $from_date : '' }}" class="form-control w-150px" name="from_date" id="from-date" placeholder="{{ __('backend.filter.enter_from_date') }}" onfocus="(this.type='date')" onblur="(this.type='text')">
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-section">
                                    <div class="card-toolbar mx-4">
                                        <label class="fs-7 me-3 fw-bold text-gray-600">{{ __('backend.filter.enter_to_date') }}</label>
                                        <div class="d-flex justify-content-center min-w-150px">
                                            <input type="text" value="{{ isset($to_date) ? $to_date : '' }}" class="form-control w-150px" name="to_date" id="to-date" placeholder="{{ __('backend.filter.enter_to_date') }}" onfocus="(this.type='date')" onblur="(this.type='text')">
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-section">
                                    <div class="card-toolbar mx-4">
                                        <label class="fs-7 me-3 fw-bold text-gray-600">{{ __('backend.filter.order_status') }}</label>
                                        <div class="d-flex justify-content-center min-w-150px">
                                            <select class="form-select" id="status" name="status" data-control="select2" data-hide-search="true" data-placeholder="{{ __('backend.filter.order_status') }}" data-kt-ecommerce-product-filter="status" data-allow-clear=true>
                                                <option></option>
                                                <option value="all" {{ Request::get('status') == 'all' ? 'selected' : '' }}>{{ __('backend.filter.all') }}</option>
                                                <option value="0" {{ Request::get('status') == '0' ? 'selected' : '' }}>{{ __('backend.filter.processing') }}</option>
                                                <option value="1" {{ Request::get('status') == '1' ? 'selected' : '' }}>{{ __('backend.filter.completed') }}</option>
                                                <option value="2" {{ Request::get('status') == '2' ? 'selected' : '' }}>{{ __('backend.filter.awating_shipment') }}</option>
                                                <option value="3" {{ Request::get('status') == '3' ? 'selected' : '' }}>{{ __('backend.filter.shipped') }}</option>
                                                <option value="4" {{ Request::get('status') == '4' ? 'selected' : '' }}>{{ __('backend.filter.tope_pickup') }}</option>
                                                <option value="5" {{ Request::get('status') == '5' ? 'selected' : '' }}>{{ __('backend.filter.already_pickup') }}</option>
                                                <option value="6" {{ Request::get('status') == '6' ? 'selected' : '' }}>{{ __('backend.filter.cancelled') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-section">
                                    <div class="card-toolbar mx-4">
                                        <label class="fs-7 me-3 fw-bold text-gray-600">{{ __('backend.order.order_type') }}</label>
                                        <div class="d-flex justify-content-center min-w-150px">
                                            <select class="form-select" id="order_type_filter" name="order_type_filter" data-control="select2" data-hide-search="true" data-placeholder="{{ __('backend.order.order_type') }}" data-kt-ecommerce-product-filter="order_type_filter" data-allow-clear=true>
                                                <option></option>
                                                <option value="all" {{ Request::get('order_type_filter') == 'all' ? 'selected' : '' }}>{{ __('backend.filter.all') }}</option>
                                                <option value="0" {{ Request::get('order_type_filter') == '0' ? 'selected' : '' }}>{{ __('backend.order.retail') }}</option>
                                                <option value="1" {{ Request::get('order_type_filter') == '1' ? 'selected' : '' }}>{{ __('backend.order.whole_sale') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-section">
                                    <div class="card-toolbar mx-4">
                                        <label class="fs-7 me-3 fw-bold text-gray-600">{{ __('backend.filter.location') }}</label>
                                        <div class="d-flex justify-content-center min-w-150px">
                                            <select class="form-select" id="location_filter" name="location_filter" data-control="select2" data-hide-search="true" data-placeholder="{{ __('backend.filter.location') }}" data-kt-ecommerce-product-filter="location_filter" data-allow-clear=true>
                                                <option></option>
                                                <option value="all" {{ Request::get('location_filter') == 'all' ? 'selected' : '' }}>{{ __('backend.filter.all') }}</option>
                                                <option value="hk" {{ Request::get('location_filter') == 'hk' ? 'selected' : '' }}>{{ __('backend.filter.hong_kong') }}</option>
                                                <option value="ma" {{ Request::get('location_filter') == 'ma' ? 'selected' : '' }}>{{ __('backend.filter.macau') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-section">
                                    <div class="card-toolbar mx-4">
                                        <label class="fs-7 me-3 fw-bold text-gray-600">{{ __('backend.filter.enter_order_num') }}</label>
                                        <div class="d-flex justify-content-center min-w-150px">
                                            <input type="text" value="{{ isset($order_number) ? $order_number : '' }}" class="form-control w-200px" name="order_number" id="order-number" placeholder="{{ __('backend.filter.enter_order_num') }}">
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
                                        <th class="min-w-150px">{{__('backend.order.order_id')}}</th>
                                        <th class="min-w-150px">{{__('backend.order.customer')}}</th>
                                        <th class="min-w-150px">{{ __('backend.order.order_type') }}</th>
                                        <th class="min-w-100px">{{__('backend.order.qty')}}</th>
                                        <th class="min-w-150px">{{__('backend.order.payment_type')}}</th>
                                        <th class="min-w-150px">{{__('backend.order.order_status')}}</th>
                                        <th class="min-w-150px">{{__('backend.order.payment_status')}}</th>
                                        <th class="min-w-150px">{{__('backend.order.delivery_status')}}</th>
                                        <th class="min-w-100px">{{__('backend.order.total')}}</th>
                                        <th class="min-w-150px">{{__('backend.order.order_date')}}</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold text-gray-600">
                                    @foreach($orders as $item)
                                       <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->code }}</td>
                                            <td>
                                                @if (isset($item->member))
                                                    {{ $item->member->getFullName() }}
                                                @elseif ($item->billing_addresses)
                                                    {{ $item->billing_addresses['first_name'].' '.$item->billing_addresses['last_name'] }}
                                                @elseif ($item->shipping_addresses)
                                                    {{ $item->shipping_addresses['first_name'].' '.$item->shipping_addresses['last_name'] }}
                                                @elseif ($item->pickup_datas)
                                                    {{ $item->pickup_datas['first_name'].' '.$item->pickup_datas['last_name'] }}
                                                {{-- @else 
                                                    {{ $item->member->getFullName() }} --}}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->is_whole_sale ? __('backend.order.whole_sale') : __('backend.order.retail') }}
                                            </td>
                                            <td>{{ $item->total_quantity }}</td>
                                            <td>{{ $item->payment_type }}</td>
                                            <td class="orderStatusChange" data-id="{{$item->id}}" data-status="{{$item->order_status}}" data-statusName="{{$item->order_status->name}}" style="cursor:default;">{{ $item->getOrderStatus() }}</td>
                                            <td>{{ $item->getPaymentStatus() }}</td>
                                            <td>{{ $item->delivery_status }}</td>
                                            <td>{{ $item->total_amount }}</td>
                                            <td>{{ $item->created_date }}</td>
                                       </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row my-3">
                            <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                                {{ Admin::tableLength($orders) }}
                            </div>
                            <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                <div class="pagination-wrapper"> {!! $orders->appends([
                                    'search'            => Request::get('search'),
                                    'from_date'         => Request::get('from_date'),
                                    'to_date'           => Request::get('to_date'),
                                    'status'            => Request::get('status'),
                                    'order_type_filter' => Request::get('order_type_filter'),
                                    'location_filter'   => Request::get('location_filter'),
                                    'page'              => Request::get('page'),
                                    'display'           => Request::get('display'),
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
        $('#search').on('keypress', function(e){
            if (e.keyCode == 13) {
                $('#export-all').prop('disabled', true);
                $('#order-report-form').submit();
            }
        });

        $('#status').on('change', function() {
            $('#order-report-form').submit();
        })

        $('#order_type_filter').on('change', function() {
            $('#order-report-form').submit();
        })

        $('#location_filter').on('change', function() {
            $('#order-report-form').submit();
        })

        $('#order-number').on('keypress', function(e){
            if (e.keyCode == 13) {
                $('#export-all').prop('disabled', true);
                $('#order-report-form').submit();
            }
        });

        $('#display').on('change', function(){
            $('#order-report-form').submit();
        })

        $('#clear-filter').on('click', function () {
            window.location.href = "order-report";
        });
    });  
</script>
@endpush