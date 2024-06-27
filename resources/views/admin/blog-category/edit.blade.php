@extends('admin.layouts.master')
@section('title', __('backend.sidebar.blog_category'))
@section('breadcrumb', __('backend.sidebar.blog_category'))
@section('breadcrumb-info', __('backend.sidebar.blog_category'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($blogcategory, [
                        'method' => 'PATCH',
                        'url' => ['/admin/blog-category', $blogcategory->id],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.blog-category.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
