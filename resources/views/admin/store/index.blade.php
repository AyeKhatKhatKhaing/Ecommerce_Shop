@extends('admin.layouts.master')
@section('title', __('backend.sidebar.store'))
@section('breadcrumb', __('backend.sidebar.store'))
@section('breadcrumb-info', __('backend.sidebar.store'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0"> 
                        <h3 class="card-title">
                            {{ __('backend.sidebar.store_lists') }}
                        </h3>
                        <div class="card-toolbar">
                            <a href="{{ url('/admin/store/create') }}" class="btn btn-primary " title="Add New User">
                                <i class="bi bi-plus-lg"></i> {{ __('backend.common.add_new') }}
                            </a>
                        </div>
                    </div>
                    <form method="get" action="{{ url('/admin/store') }}" id="store-form" class="filter-clear-form">
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
                                    <tr class="text-start text-gray-400 fw-boldest fs-7 text-uppercase gs-0">
                                        <th class="w-50px" style="padding-left: 10px;">#</th>
                                        <th class="min-w-150px">{{ __('backend.store.name') }}</th>
                                        <th class="min-w-150px">{{ __('backend.store.address') }}</th>
                                        <th class="min-w-150px">{{ __('backend.store.email') }}</th>
                                        <th class="min-w-150px">{{ __('backend.store.phone') }}</th>
                                        <th class="min-w-150px">{{ __('backend.common.enable') }}</th>
                                        <th class="min-w-150px">{{ __('backend.common.last_updated') }}</th>
                                        <th class="sticky text-center min-w-150px">{{ __('backend.common.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($store as $item)
                                        <tr>
                                            <td style="padding-left: 10px;">{{ $loop->iteration }}</td>
                                            <td>{{ $item->name_hant }}</td>
                                            <td>{!! isset($item->addresses) && isset($item->addresses['hant']) ? $item->addresses['hant'] : ''!!}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" id="switcher_checkbox_{{ $item->id }}"
                                                        type="checkbox" onclick="statusChange({{ $item->id }}, '/admin/store/status-change')"
                                                        name="status{{ $item->id }}"
                                                        {{ $item->status ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="fw-bold">{{ $item->updateUser ? $item->updateUser->name : '' }}</span><br>
                                                <span class="text-muted">{{ $item->updated_at }}</span>
                                            </td>
                                            <td class="sticky text-center">
                                                <a href="{{ url('/admin/store/' . $item->id . '/edit') }}" title="Edit Store">
                                                    <button class="btn btn-icon btn-active-light-primary btn btn-primary w-30px h-30px"><i class="bi bi-pencil-square" aria-hidden="true"></i></button></a>
                                                <form method="POST" action="{{ url('/admin/store' . '/' . $item->id) }}" class="deleteForm" style="display: inline;">                
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
                                {{ Admin::tableLength($store) }}
                            </div>
                            <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                <div class="pagination-wrapper"> {!! $store->appends([
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
            $('#status').on('change', function() {
                $('#store-form').submit();
            });

            $('#display').on('change', function () {
                $('#store-form').submit();
            })
        })
    </script>
@endpush