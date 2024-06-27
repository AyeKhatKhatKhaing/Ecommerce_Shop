@extends('admin.layouts.master')
@section('title', __('backend.sidebar.pages'))
@section('breadcrumb', __('backend.sidebar.pages'))
@section('breadcrumb-info', __('backend.sidebar.pages'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($page, [
                        'method' => 'PATCH',
                        'url' => ['/admin/page', $page->id],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.page.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
