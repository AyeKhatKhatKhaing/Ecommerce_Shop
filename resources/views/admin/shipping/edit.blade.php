@extends('admin.layouts.master')
@section('title', __('backend.sidebar.shipping'))
@section('breadcrumb', __('backend.sidebar.shipping'))
@section('breadcrumb-info', __('backend.sidebar.shipping'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($shipping, [
                        'method' => 'PATCH',
                        'url' => ['/admin/shipping', $shipping->id],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.shipping.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
