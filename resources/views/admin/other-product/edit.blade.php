@extends('admin.layouts.master')
@section('title', 'Edit Other Product')
@section('breadcrumb', 'Edit Other Product')
@section('breadcrumb-info', 'Edit Other Product')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($other_product, [
                        'method' => 'PATCH',
                        'url' => ['/admin/other-product', $other_product->id],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include('admin.other-product.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
