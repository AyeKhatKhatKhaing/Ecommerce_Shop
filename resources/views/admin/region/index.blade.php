@extends('admin.layouts.master')
@section('title', __('backend.sidebar.regions'))
@section('breadcrumb', __('backend.sidebar.country_and_region'))
@section('breadcrumb-info', __('backend.sidebar.regions'))
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        {{ __('backend.regions.regions_list') }}
                    </h3>
                    <div class="card-toolbar">
                        <a href="{{ url('/admin/regions/create') }}" class="btn btn-primary btn-hover me-2" title="Add New Region">
                            <i class="fa fa-plus" aria-hidden="true"></i>  {{ __('backend.common.add_new') }}
                        </a>
                    </div>
                </div>
                <form method="get" action="{{ route('regions.index') }}" id="region-form" class="filter-clear-form">
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
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-bordered fs-6 gy-5 dataTable no-footer">
                            <thead>
                                <tr class="text-start text-gray-600 fw-boldest fs-7 text-uppercase gs-0">
                                    <th>#</th>
                                    <th>{{ __('backend.regions.country_name') }}</th>
                                    <th>{{ __('backend.regions.region_name') }}</th>
                                    <th>{{ __('backend.common.enable') }}</th>
                                    <th>{{ __('backend.common.last_updated') }}</th>
                                    <th class="sticky text-center">{{ __('backend.common.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="fw-bold text-gray-600">
                                @foreach($regions as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->country ? $item->country->name_hant : '' }}</td>
                                    <td>{{ $item->name_hant }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" id="switcher_checkbox_{{ $item->id }}"
                                                type="checkbox" onclick="statusChange({{ $item->id }}, '/admin/regions/status-change')"
                                                name="status{{ $item->id }}"
                                                {{ $item->status ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->updateUser ? $item->updateUser->name : '' }}</span><br>
                                        <span class="text-muted">{{ $item->updated_at }}</span>
                                    </td>
                                    <td class="sticky text-center">
                                        <a href="{{ url('/admin/regions/' . $item->id . '/edit') }}" title="Edit Region">
                                            <button class="btn btn-icon btn-active-light-primary btn btn-primary w-30px h-30px">
                                                <i class="bi bi-pencil-square" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                        {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/admin/regions', $item->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<i class="bi bi-trash" aria-hidden="true"></i>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-icon btn-active-light-danger btn-danger w-30px h-30px show_confirm_delete',
                                        'title' => 'Delete Region',
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                            {{ Admin::tableLength($regions) }}
                        </div>
                        <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                            <div class="pagination-wrapper"> {!! $regions->appends([
                                'search' => Request::get('search'),
                                'status' => Request::get('status'),
                                'page' => Request::get('page'),
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
            $('#region-form').submit();
        })
        $('#display').on('change', function() {
            $('#region-form').submit();
        })
    });
</script>
@endpush