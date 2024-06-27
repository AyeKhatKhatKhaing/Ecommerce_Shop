@extends('admin.layouts.master')
@section('title', __('backend.sidebar.category'))
@section('breadcrumb', __('backend.sidebar.category'))
@section('breadcrumb-info', __('backend.sidebar.category'))
@section('content')
<div class="container">
    {!! Form::open(['url' => '/admin/product-attribute', 'class' => 'form-horizontal', 'files' => true, 'id' => "kt_docs_formvalidation_text"]) !!}
    <div class="row mx-1">
        @if ($errors->any())

        @endif
    </div>
    <div class="row">
        @include('admin.attribute.form', ['formMode' => 'create'])
    </div>
    
    {!! Form::close() !!}
</div>
@endsection