@extends('admin.layouts.master')
@section('title', __('backend.sidebar.order'))
@section('breadcrumb', __('backend.order.order_list'))
@section('breadcrumb-info', __('backend.order.order_list'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('admin.order._order_status')
                    <form method="get" action="{{ url('/admin/order?type=ma') }}" id="ma-order-form" class="filter-clear-form">
                        <div class="card-header border-0"> 
                            <h3 class="card-title">
                                {{__('backend.order.order_list')}}
                            </h3>
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end me-3" data-kt-customer-table-toolbar="base">
                                    <button type="submit" class="btn btn-primary" name="export" value="export-btn" id="export-all">
                                        <i class="fas fa-file-export"></i> {{__('backend.filter.export')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="type" value="ma">
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
                                        <th class="min-w-150px">{{__('backend.order.order_date')}}</th>
                                        <th class="min-w-100px">{{__('backend.order.total')}}</th>
                                        <th class="sticky text-center min-w-125px">{{__('backend.common.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold text-gray-600">
                                    @foreach($orders as $item)
                                        <tr>
                                            <td style="padding-left: 10px;">{{ $loop->iteration }}</td>
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
                                            <td>{{ $item->created_date }}</td>
                                            <td>{{ $item->total_amount }}</td>
                                            <td class="sticky text-center">
                                                <a href="#" title="Send Mail" data-bs-toggle="modal" data-bs-target="#sendStatusMail{{ $item->id }}">
                                                    <button class="btn btn-icon btn-active-light-success btn btn-success w-30px h-30px">
                                                        <i class="bi bi-send" aria-hidden="true"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ url('admin/order/'.$item->id.'?type=ma') }}" title="View Order Details">
                                                    <button class="btn btn-icon btn-active-light-info btn btn-info w-30px h-30px">
                                                        <i class="bi bi-eye" aria-hidden="true"></i>
                                                    </button>
                                                </a>
                                            </td>
                                            @include('admin.order._status_modal')
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
                                    'type'    => 'ma',
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
    $(document).ready(function () {
        $('#search').on('keypress', function(e){
            if (e.keyCode == 13) {
                $('#export-all').prop('disabled', true);
                $('#ma-order-form').submit();
            }
        });

        $('#status').on('change', function() {
            $('#ma-order-form').submit();
        })

        $('#order_type_filter').on('change', function() {
            $('#ma-order-form').submit();
        })

        $('#from-date').on('change', function() {
            var from_date = $(this).val();
            var to_date   = $("#to-date").val();
            prepareUrl("from_date", from_date);
            prepareUrl("to_date", to_date);
            if (to_date != '') {
                location.reload();
            }
        });
        $('#to-date').on('change', function() {
            var to_date = $(this).val();
            var from_date = $("#from-date").val();
            prepareUrl("from_date", from_date);
            prepareUrl("to_date", to_date);
            if (from_date != '') {
                location.reload();
            }
        });

        $('#display').on('change', function(){
            $('#ma-order-form').submit();
        })
    });  

    function prepareUrl(key, value) {
        const currentUrl = window.location.href;
        const urlParams  = new URLSearchParams(window.location.search);
        urlParams.set(key, value);

        let main_url = window.location.href.split('?')[0];
            main_url += "?" + urlParams.toString();
            window.history.pushState('', '', main_url);
    }
</script>
{{-- <script>
    $('.orderStatusChange').on('click', function() {
        $('#orderStatusUpdate').modal('show');

        var id = $(this).data('id');
        var order_status = $(this).data('status');
        var statusName = $(this).data('statusname');
        $("input[name='order_id']").val(id);
        $('#orderStatusText').html(statusName);
        
        var country = document.getElementById("orderStatus");
        country.value = order_status;
        country.options[country.selectedIndex].selected = true;

    });
</script> --}}
@endpush