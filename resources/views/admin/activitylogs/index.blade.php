@extends('admin.layouts.master')
@section('title', 'Activity Logs')
@section('breadcrumb', 'Activity Logs')
@section('breadcrumb-info', 'Activity Logs')
@section('content')
<div class="container">
        <div class="row mx-1">
            @if ($errors->any())
                <x-errors :errors="$errors" />
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="get" action="{{ route('activitylogs.index') }}" id="activity">
                        <div class="card-header border-0 pt-6">
                            <div class="card-title">
                                <h3>Activity Logs</h3>
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
                                    <th class="w-50px" style="padding-left: 10px;">ID</th>
                                        <th class="min-w-150px">Activity</th>
                                        <th class="min-w-100px">Actor</th>
                                        <th class="min-w-250px">Properties</th>
                                        <th class="min-w-200px">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($activitylogs as $key => $item)
                                        <tr>
                                            <td style="padding-left: 10px;">{{ $loop->iteration }}</td>
                                            <td>
                                                @php
                                                $ext = explode('\\', $item->description);
                                                @endphp
                                                @if(isset($ext[0]))
                                                    {{$ext[0]}}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->causer)
                                                    <a href="{{ route('users.edit' , $item->causer->id) }}">{{ $item->causer->name }}</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($item->properties) && $item->properties != "[]")
                                                    @if(isset($item->changes['old']))
                                                        @php
                                                            $olds = $item->changes['old'];
                                                        @endphp
                                                        <span  class="text-dark fw-bolder">OLD :</span> <br>
                                                        <div class="ms-1">
                                                            @foreach($item->changes['old'] as $key => $old_data)
                                                                <span>{{ $key }}</span> : 
                                                                @if(!empty($old_data))
                                                                    @if (is_array($old_data))   
                                                                        <span class="text-muted">
                                                                            @foreach ($old_data as $lang => $data)
                                                                                <span class="text-success">{{ $lang }}</span> : {{ $data }}
                                                                                {{ !$loop->last ? ',' : '' }}
                                                                            @endforeach
                                                                        </span>
                                                                    @else
                                                                       <span class="text-muted">{{ $old_data }} </span>
                                                                    @endif
                                                                    {{ !$loop->last ? ',' : '' }}
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    @if(isset($item->changes['attributes']))
                                                        <span  class="text-dark fw-bolder">NEW :</span> <br>
                                                        <div class="ms-1">
                                                            @foreach($item->changes['attributes'] as $key => $attr_data)
                                                                @if(!empty($attr_data))
                                                                    <span>{{ $key }}</span> :
                                                                    @if (is_array($attr_data))
                                                                        {{-- <span>{{ $key }}</span> : --}}
                                                                        @if(isset($olds[$key]) && $olds[$key] != $attr_data)
                                                                            <span class="text-danger">
                                                                                @foreach ($attr_data as $lang => $data)
                                                                                    <span class="text-success">{{ $lang }}</span> : {{ $data }}
                                                                                    {{ !$loop->last ? ',' : '' }}
                                                                                @endforeach
                                                                            </span>
                                                                        @else
                                                                            <span class="text-{{ empty($olds[$key]) ? 'danger' : 'muted' }}">
                                                                                @foreach ($attr_data as $lang => $data)
                                                                                    <span class="text-success">{{ $lang }}</span> : {{ $data }}
                                                                                        {{ !$loop->last ? ',' : '' }}
                                                                                @endforeach
                                                                            </span>
                                                                        @endif
                                                                    @else
                                                                        {{-- <span>{{ $key }}</span> : --}}
                                                                        @if(isset($olds[$key]) && $olds[$key] != $attr_data)
                                                                            <span class="text-danger">{{ $attr_data }}</span>
                                                                        @else
                                                                            <span class="text-{{ empty($olds[$key]) ? 'danger' : 'muted' }}">{{ $attr_data }}</span>
                                                                        @endif
                                                                    @endif
                                                                    {{ !$loop->last ? ',' : '' }}
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $item->created_at }}</td>
                                        </tr>                                   
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row my-3">
                            <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                                {{ Admin::tableLength($activitylogs) }}
                            </div>
                            <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                <div class="pagination-wrapper"> {!! $activitylogs->appends([
                                    'search'  => Request::get('search'),
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

        $('#display').on('change', function(){
            $('#activity').submit();
        })
    
    });  
</script>
@endpush