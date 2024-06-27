@extends('admin.layouts.master')
@section('title', __('backend.sidebar.attributes'))
@section('breadcrumb', __('backend.sidebar.products'))
@section('breadcrumb-info', __('backend.sidebar.attributes'))
@section('content')
    <div class="container">
        {!! Form::model($attribute_term, [
            'method' => 'PATCH',
            'url' => ['/admin/product-attribute', $attribute_term->id],
            'class' => 'form-horizontal',
        ]) !!}

            <div class="row mx-1">
                @if ($errors->any())
                   
                @endif
            </div>
            <div class="row">
                @include('admin.attribute.form', ['formMode' => 'edit'])
            </div>
            
        {!! Form::close() !!}
    </div>
@endsection
