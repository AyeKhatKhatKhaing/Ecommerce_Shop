@php
    $locale_name = "name_".lngKey();
@endphp
<div>
    <div class="row gy-5 g-xl-8">
        <div class="col-xl-12">
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">This Month Top Best Seller</span>
                    </h3>
                    <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Click to add a user">
                        <div class="d-flex align-items-center fw-bolder">
                            <select class="form-select form-select-transparent text-graY-800 fs-base lh-1 fw-bolder py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option">
                                <option></option>
                                <option value="Show All" selected="selected">Select Months</option>
                                <option value="a">January</option>
                                <option value="b">February</option>
                                <option value="c">March</option>
                                <option value="d">Aprial</option>
                                <option value="e">May</option>
                                <option value="f">June</option>
                                <option value="g">July</option>
                                <option value="h">August</option>
                                <option value="i">Septrmber</option>
                                <option value="j">October</option>
                                <option value="k">November</option>
                                <option value="l">December</option>
                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body py-3 overflow-scroll h-500px">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-boldest text-muted">
                                    <th class="w-50px">#</th>
                                    <th class="min-w-200px">NAME</th>
                                    <th class="min-w-100px">SKU</th>
                                    <th class="min-w-100px">PRICE</th>
                                    <th class="min-w-150px">TOTAL SALE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($popular_products) && count($popular_products) > 0)
                                    @foreach ($popular_products as $popular_product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span class=" fw-bold text-muted d-block fs-7">{{ $popular_product->$locale_name }}</span>
                                            </td>
                                            <td>
                                                <span class=" fw-bold text-muted d-block fs-7">{{ $popular_product->sku }}</span>
                                            </td>
                                            <td>
                                                <span class=" fw-bold text-muted d-block fs-7">{{ $popular_product->currency_type }}{{ $popular_product->original_price }}</span>
                                            </td>
                                            <td>
                                                <span class=" fw-bold text-muted d-block fs-7">{{ $popular_product->currency_type }}{{ $popular_product->sale_price }}</span>
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