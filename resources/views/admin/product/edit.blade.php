@extends('admin.layouts.master')
@section('title', __('backend.sidebar.products'))
@section('breadcrumb', __('backend.sidebar.products'))
@section('breadcrumb-info', __('backend.sidebar.products'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($product, [
                        'method' => 'PATCH',
                        'url' => ['/admin/product', $product->id],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.product.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
