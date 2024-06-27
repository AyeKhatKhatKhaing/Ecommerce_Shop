@extends('admin.layouts.master')
@section('title', __('backend.sidebar.member_report'))
@section('breadcrumb', __('backend.member_report.member_report_list'))
@section('breadcrumb-info', __('backend.member_report.member_report_list'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="get" action="{{ url('/admin/member-report') }}" id="member-report-form" class="filter-clear-form">
                        <div class="card-header border-0"> 
                            <h3 class="card-title">
                                {{ __('backend.member_report.member_report_list') }}
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
                                            <select class="form-select form-select-solid" id="status" name="status" data-control="select2" data-hide-search="true" data-placeholder="{{ __('backend.filter.status') }}" data-kt-ecommerce-product-filter="status" data-allow-clear="true">
                                                <option></option>
                                                <option value="all" {{ Request::get('status') == 'all' ? 'selected' : '' }}>{{ __('backend.filter.all') }}</option>
                                                <option value="1" {{ Request::get('status') == '1' ? 'selected' : '' }}>{{ __('backend.filter.active') }}</option>
                                                <option value="0" {{ Request::get('status') == '0' ? 'selected' : '' }}>{{ __('backend.filter.inactive') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-section">
                                    <div class="card-toolbar mx-4">
                                        <label class="fs-7 me-3 fw-bold text-gray-600">{{ __('backend.filter.member_type') }}</label>
                                        <div class="d-flex justify-content-center min-w-150px">
                                            <select class="form-select form-select-solid" id="memberTypeFilter" name="member_type_filter" data-control="select2" data-hide-search="true" data-placeholder="{{ __('backend.filter.member_type') }}" data-kt-ecommerce-product-filter="memberTypeFilter" data-allow-clear="true">
                                                <option></option>
                                                <option value="all" {{ Request::get('member_type_filter') == 'all' ? 'selected' : '' }}>{{ __('backend.filter.all') }}</option>
                                                @foreach ($member_types as $member_type)
                                                    <option value="{{$member_type->id}}" {{ Request::get('member_type_filter') == $member_type->id ? 'selected' : '' }}>{{ $member_type->name_en }}</option>
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
                                        <th class="min-w-100px">{{ __('backend.member_report.email') }}</th>
                                        <th class="min-w-100px">{{ __('backend.member_report.name') }}</th>
                                        <th class="min-w-100px">{{ __('backend.member_report.address') }}</th>
                                        <th class="min-w-100px">{{ __('backend.member_report.contact') }}</th>
                                        <th class="min-w-100px">{{ __('backend.member_report.company_name') }}</th>
                                        <th class="min-w-100px">{{ __('backend.member_report.industry') }}</th>
                                        <th class="min-w-100px">{{ __('backend.member_report.website') }}</th>
                                        <th class="min-w-100px">{{ __('backend.member_report.retail_whole_sale') }}</th>
                                        <th class="min-w-100px">{{ __('backend.member_report.customer_level') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold text-gray-600">
                                    @foreach($member as $item)
                                        <tr>
                                            <td style="padding-left: 10px;">{{ $loop->iteration }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->getFullName() }}</td>
                                            <td>
                                                {{ isset($item->member_address) && $item->member_address['billing_address'] ? $item->member_address['billing_address']['address'].', '.$item->member_address['billing_address']['address_detail'] : '' }}
                                            </td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->company_name ? $item->company_name : '' }}</td>
                                            <td>{{ $item->business_type ? $item->business_type : '' }}</td>
                                            <td>{{ $item->company_website ? $item->company_website : '' }}</td>
                                            <td>
                                                @if ($item->account_type == 'individual')
                                                    Retail
                                                @else
                                                    WholeSale
                                                @endif
                                            </td>
                                            <td>{{ isset($item->member_type) ? $item->member_type->name_hant : '' }}</td>
                                        </tr>                                   
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row my-3">
                            <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                                {{ Admin::tableLength($member) }}
                            </div>
                            <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                <div class="pagination-wrapper"> {!! $member->appends([
                                    'search'             => Request::get('search'),
                                    'page'               => Request::get('page'),
                                    'status'             => Request::get('status'),
                                    'member_type_filter' => Request::get('member_type_filter'),
                                    'display'            => Request::get('display'),
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
        $('document').ready(function() {
            $('#search').on('keypress', function(e){
                if (e.keyCode == 13) {
                    $('#export-all').prop('disabled', true);
                    $('#member-report-form').submit();
                }
            });

            $('#status').on('change', function() {
                $('#member-report-form').submit();
            });

            $('#memberTypeFilter').on('change', function() {
                $('#member-report-form').submit();
            });

            $('#display').on('change', function() {
                $('#member-report-form').submit();
            })

        })
    </script>
@endpush