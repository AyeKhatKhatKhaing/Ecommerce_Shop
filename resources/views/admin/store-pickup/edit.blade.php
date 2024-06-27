@extends('admin.layouts.master')
@section('title', __('backend.sidebar.store_pickup'))
@section('breadcrumb', __('backend.sidebar.store'))
@section('breadcrumb-info', __('backend.sidebar.store_pickup'))
@section('content')
<div class="container">
    {!! Form::model($pickup, [
    'method' => 'PATCH',
    'url' => ['/admin/store-pickups', $pickup->id],
    'class' => 'form-horizontal',
    ]) !!}

    <div class="row mx-1">
        @if ($errors->any())

        @endif
    </div>
    <div class="row">
        @include('admin.store-pickup.form', ['formMode' => 'edit'])
    </div>
    <div class="row mt-4">
        <div class="col-md-8 mt-4 form-group">
            <div class="form-group">
                <div class="form-group">
                    <div class="float-left">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                            {{ __('backend.common.save') }}</button>
                        <button type="button" class="btn btn-secondary cancel" onclick="window.location='{{ url('/admin/store-pickups') }}'"><i class="bi bi-x" aria-hidden="true"></i>  {{ __('backend.common.cancel') }}</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection