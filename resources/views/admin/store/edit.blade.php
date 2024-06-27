@extends('admin.layouts.master')
@section('title', __('backend.sidebar.store'))
@section('breadcrumb', __('backend.sidebar.store'))
@section('breadcrumb-info', __('backend.sidebar.store'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($store, [
                        'method' => 'PATCH',
                        'url' => ['/admin/store', $store->id],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.store.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
