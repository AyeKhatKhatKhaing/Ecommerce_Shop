@extends('admin.layouts.master')
@section('title', __('backend.sidebar.store_distribution'))
@section('breadcrumb', __('backend.sidebar.store_distribution'))
@section('breadcrumb-info', __('backend.sidebar.store_distribution'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($storedistribution, [
                        'method' => 'POST',
                        'url' => ['/admin/store-distribution'],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.store-distribution.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
