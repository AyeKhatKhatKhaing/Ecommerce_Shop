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

                {!! Form::open(['url' => '/admin/page', 'class' => 'form-horizontal', 'files' => true]) !!}

                @include ('admin.page.form', ['formMode' => 'create'])

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
