@extends('admin.layouts.master')
@section('title', __('backend.sidebar.product_label'))
@section('breadcrumb', __('backend.sidebar.product_label'))
@section('breadcrumb-info', __('backend.sidebar.product_label'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($productlabel, [
                        'method' => 'PATCH',
                        'url' => ['/admin/product-label', $productlabel->id],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.product-label.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
