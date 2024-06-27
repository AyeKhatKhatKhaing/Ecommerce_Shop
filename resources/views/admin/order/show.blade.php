@extends('admin.layouts.master')
@section('title', __('backend.sidebar.order'))
@section('breadcrumb', __('backend.order.order_detail'))
@section('breadcrumb-info', __('backend.order.order_detail'))
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="text-gray">#{{ $order->code ? $order->code : '' }} {{__('backend.order.order_detail')}}</h1>
        </div>
        <!-- Modal -->
        @include('admin.order._status_modal', ['item' => $order])
         <!-- end:Modal -->
        <div class="col-md-4 text-end">
            <div class="form-group">
                <div class="form-group">
                    <div class="float-left">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#sendStatusMail{{ $order->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-arrow-up" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v4.5a.5.5 0 0 1-1 0V5.383l-7 4.2-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h5.5a.5.5 0 0 1 0 1H2a2 2 0 0 1-2-1.99V4Zm1 7.105 4.708-2.897L1 5.383v5.722ZM1 4v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1Z"/>
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.354-5.354 1.25 1.25a.5.5 0 0 1-.708.708L13 12.207V14a.5.5 0 0 1-1 0v-1.717l-.28.305a.5.5 0 0 1-.737-.676l1.149-1.25a.5.5 0 0 1 .722-.016Z"/>
                            </svg> {{__('backend.order.send_mail')}}
                        </button>
                        <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('admin/order?type='.$order_type) }}'">
                            <i class="bi bi-arrow-90deg-left"></i> {{__('backend.order.back')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-flush pt-3 mb-xl-10 mt-5">
        <div class="card-header">
            <div class="card-title">
                <h2 class="fw-bolder">{{__('backend.order.general_information')}}</h2>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="mb-10">
                <div class="d-flex flex-wrap py-5">
                    <div class="flex-equal me-5">
                        <table class="table fs-6 fw-bold gs-0 gy-2 gx-2 m-0">
                            <tbody><tr>
                                <td class="text-gray-400 min-w-175px w-175px">{{__('backend.order.order_no')}}</td>
                                <td class="text-gray-800 min-w-200px">
                                   {{ $order ? $order->code : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-gray-400">{{__('backend.order.order_date')}}</td>
                                <td class="text-gray-800">{{ $order ? date('d/m/Y', strtotime($order->created_date)) : '' }}</td>
                            </tr>
                            <tr>
                                <td class="text-gray-400">{{__('backend.order.payment_type')}}</td>
                                <td class="text-gray-800">{{ $order ? $order->payment_method : '' }}</td>
                            </tr>
                            <tr>
                                <td class="text-gray-400">{{__('backend.order.shipping_method')}}</td>
                                <td class="text-gray-800">{{ $order ? $order->delivery_type : ''  }}</td>
                            </tr>
                            <tr>
                                <td class="text-gray-400">{{__('backend.order.store')}}</td>
                                <td class="text-gray-800">{{ $order ? $order->location : '' }}</td>
                            </tr>
                            <tr>
                                <td class="text-gray-400">{{__('backend.order.order_status')}}</td>
                                <td class="text-gray-800">{{ $order ? $order->getOrderStatus($order->order_status) : '' }}</td>
                            </tr>
                            <tr>
                                <td class="text-gray-400">{{__('backend.order.payment_status')}}</td>
                                <td class="text-gray-800">{{ $order ? $order->getPaymentStatus($order->get_payment_status) : '' }}</td>
                            </tr>
                        </tbody></table>
                    </div>
                    <div class="flex-equal me-5">
                        <table class="table fs-6 fw-bold gs-0 gy-2 gx-2 m-0">
                            <tbody><tr>
                                <td class="text-gray-400 min-w-175px w-175px">{{__('backend.order.country')}}</td>
                                <td class="text-gray-800 min-w-200px">
                                    {{ $order->member && $order->member->country ? $order->member->country->name_hant : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-gray-400">{{__('backend.order.member_id')}}</td>
                                <td class="text-gray-800">{{ $order->member ? $order->member->code : '' }}</td>
                            </tr>
                            <tr>
                                <td class="text-gray-400">{{__('backend.order.member_type')}}</td>
                                <td class="text-gray-800">{{ $order->member && $order->member->member_type ? $order->member->member_type->name_hant : '' }}</td>
                            </tr>
                            <tr>
                                <td class="text-gray-400">{{__('backend.order.reward_points')}}</td>
                                <td class="text-gray-800"></td>
                            </tr>                        
                        </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4 mb-10">
        <div class="card-body row">
            <div class="col-md-6">
                <h3 class="pb-3">
                    {{__('backend.order.billing_address')}}
                </h3>
                <div class="px-5">
                    <div class="row border rounded-4 me-1 p-2 mb-2">
                        <div class="col-6 py-2">{{__('backend.order.name')}}</div>
                        <div class="col-6 py-2">{{ isset($order->billing_addresses) ? $order->billing_addresses['first_name'] .' '. $order->billing_addresses['last_name'] : '' }}</div>
                        <div class="col-6 py-2">{{__('backend.order.phone_number')}}</div>
                        <div class="col-6 py-2">{{ isset($order->billing_addresses) ? $order->billing_addresses['phone'] : '' }}</div>
                        <div class="col-6 py-2">{{__('backend.order.email')}}</div>
                        <div class="col-6 py-2">{{ isset($order->member) ? $order->member->email : '' }}</div>
                        <div class="col-6 py-2">{{__('backend.order.address')}} </div>
                        <div class="col-6 py-2">{{ isset($order->billing_addresses) ? $order->billing_addresses['address'] : '' }}</div>
                        <div class="col-6 py-2">{{__('backend.order.city')}}</div>
                        <div class="col-6 py-2">{{ isset($order->member) ? $order->member->city : '' }}</div>
                        <div class="col-6 py-2">{{__('backend.order.country')}}</div>
                        <div class="col-6 py-2">{{ isset($order->member) && isset($order->member->country) ? $order->member->country->name_hant : '' }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h3 class="pb-3">
                    {{__('backend.order.shipping_address')}}
                </h3>
                <div class="px-5">
                    <div class="row border rounded-4 me-1 p-2 mb-2">
                        <div class="col-6 py-2">{{__('backend.order.name')}}</div>
                        <div class="col-6 py-2">{{ isset($order->shipping_addresses) ? $order->shipping_addresses['first_name'].''.$order->shipping_addresses['last_name'] : '' }}</div>
                        <div class="col-6 py-2">{{__('backend.order.phone_number')}}</div>
                        <div class="col-6 py-2">{{ isset($order->shipping_addresses) ? $order->shipping_addresses['phone'] : '' }}</div>
                        <div class="col-6 py-2">{{__('backend.order.email')}}</div>
                        <div class="col-6 py-2">{{ isset($order->member) ? $order->member->email : '' }}</div>
                        <div class="col-6 py-2">{{__('backend.order.address')}} </div>
                        <div class="col-6 py-2">{{ isset($order->shipping_addresses) ? $order->shipping_addresses['address'] : '' }}</div>
                        <div class="col-6 py-2">{{__('backend.order.city')}}</div>
                        <div class="col-6 py-2">{{ isset($order->member) ? $order->member->city : '' }}</div>
                        <div class="col-6 py-2">{{__('backend.order.country')}}</div>
                        <div class="col-6 py-2">{{ isset($order->member) && isset($order->member->country) ? $order->member->country->name_hant : '' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
        <div class="card-header">
            <div class="card-title">
                <h2>{{__('backend.sidebar.order')}} #{{ $order->code }}</h2>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                    <thead>
                        <tr class="text-start text-gray-600 fw-boldest fs-7 text-uppercase gs-0">
                            <th class="min-w-175px">{{__('backend.order.product')}}</th>
                            <th class="min-w-70px text-end">{{__('backend.order.qty')}}</th>
                            <th class="min-w-100px text-end">{{__('backend.order.unit_price')}}</th>
                            <th class="min-w-100px text-end">{{__('backend.order.total')}}</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">
                        @if ($order_items->count() > 0)
                            @foreach ($order_items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px">
                                                <img src="{{ $item->product_datas ? asset($item->product_datas['feature_image']) : '' }}" class="w-80px h-80px" alt="{{ $item->feature_image_alt ?? '' }}">
                                            </div>
                                            <div class="ms-5">
                                                <div class="fw-boldest text-gray-600">{{ $item->product_datas ? $item->product_datas['name_hant'] : '' }}</d>
                                                <div class="fs-7 mt-2 text-muted">Delivery Date: {{ date('d/m/Y', strtotime($item->created_date)) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">{{ $item->quantity }}</td>
                                    <td class="text-end">${{ $item->unit_price }}</td>
                                    <td class="text-end">${{ $item->sub_total }}</td>
                                </tr>
                            @endforeach
                        @endif
                        <tr>
                            <td colspan="4" class="text-end">{{__('backend.order.subtotal')}}</td>
                            <td class="text-end">${{ $order->total_amount }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end">{{__('backend.order.shipping_rate')}}</td>
                            <td class="text-end">$ {{ $order->shipping_amount }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="fs-3 text-dark text-end">{{__('backend.order.grand_total')}}</td>
                            @if ($order_type == 'hk')
                                <td class="text-dark fs-3 fw-boldest text-end">${{ isset($order) ? ($order->total_amount - $order->shipping_amount) : '' }}</td>
                            @else 
                                <td class="text-dark fs-3 fw-boldest text-end">${{ isset($total_amount) ? ($total_amount - $order->shipping_amount) : '' }} 
                                    <br>
                                ( HK$ {{$order->total_amount}})
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection