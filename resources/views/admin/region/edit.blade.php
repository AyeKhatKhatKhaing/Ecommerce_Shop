@extends('admin.layouts.master')
@section('title', __('backend.sidebar.regions'))
@section('breadcrumb', __('backend.sidebar.country_and_region'))
@section('breadcrumb-info', __('backend.sidebar.regions'))
@section('content')
<div class="container">
    {!! Form::model($region, [
    'method' => 'PATCH',
    'url' => ['/admin/regions', $region->id],
    'class' => 'form-horizontal',
    ]) !!}

    <div class="row mx-1">
        @if ($errors->any())

        @endif
    </div>
    <div class="row">
        @include('admin.region.form', ['formMode' => 'edit'])
    </div>
    <div class="row mt-4">
        <div class="col-md-8 mt-4 form-group">
            <div class="form-group">
                <div class="form-group">
                    <div class="float-left">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                            {{ __('backend.common.save') }}</button>
                        <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('/admin/regions') }}'"><i class="bi bi-x" aria-hidden="true"></i> {{ __('backend.common.cancel') }}</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection