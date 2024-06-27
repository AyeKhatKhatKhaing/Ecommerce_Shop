<div>
    <div class="row gy-5 g-xl-8">
        <div class="col-xl-6">
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Populer Search Keywords</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="min-w-200px">Keyword</th>
                                    <th class="min-w-100px">Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span class=" fw-bold text-muted d-block fs-7">Queen's Truffle Brandy</span>
                                    </td>
                                    <td>
                                        <span class=" fw-bold text-muted d-block fs-7">2456</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class=" fw-bold text-muted d-block fs-7">Queen's Truffle Brandy</span>
                                    </td>
                                    <td>
                                        <span class=" fw-bold text-muted d-block fs-7">2456</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class=" fw-bold text-muted d-block fs-7">Queen's Truffle Brandy</span>
                                    </td>
                                    <td>
                                        <span class=" fw-bold text-muted d-block fs-7">2456</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class=" fw-bold text-muted d-block fs-7">Queen's Truffle Brandy</span>
                                    </td>
                                    <td>
                                        <span class=" fw-bold text-muted d-block fs-7">2456</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class=" fw-bold text-muted d-block fs-7">Queen's Truffle Brandy</span>
                                    </td>
                                    <td>
                                        <span class=" fw-bold text-muted d-block fs-7">2456</span>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Most Used Coupon</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="min-w-200px">Coupon</th>
                                    <th class="min-w-100px">Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($most_use_coupons) && count($most_use_coupons) > 0)
                                    @foreach ($most_use_coupons as $coupon)
                                        <tr>
                                            <td>
                                                <span class=" fw-bold text-muted d-block fs-7">{{ $coupon->code }}</span>
                                            </td>
                                            <td>
                                                <span class=" fw-bold text-muted d-block fs-7">{{ $coupon->per_coupon_usage }}</span>
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