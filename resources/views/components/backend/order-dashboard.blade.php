<div>
    <div class="row gy-5 g-xl-8">
        <div class="col-xl-12">
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1 text-muted">Latest Order</span>
                    </h3>
                </div>
                <div class="card-body py-3 overflow-scroll h-300px">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-boldest text-muted">
                                    <th class="w-50px">#</th>
                                    <th class="min-w-200px">ITEM NAME</th>
                                    <th class="min-w-150px">CUSTOMER TYPE</th>
                                    <th class="min-w-150px">AREA</th>
                                    <th class="min-w-150px">DISTRICT</th>
                                    <th class="min-w-100px">ORDER STATUS</th>
                                    <th class="min-w-150px">TOTAL</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($orders) && count($orders) > 0)
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span class="fw-bold text-muted d-block fs-7">{{ $order->code }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-muted d-block fs-7">{{ $order->member_type_name }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-muted d-block fs-7">{{ $order->location }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-muted d-block fs-7">{{ $order->location }}</span>
                                            </td>
                                            <td>
                                                <span>{{ $order->getOrderStatus($order->order_status) }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-muted d-block fs-7">HK${{ $order->total_amount }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>