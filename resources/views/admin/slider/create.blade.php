@extends('admin.layouts.master')
@section('title', __('backend.sidebar.slider'))
@section('breadcrumb', __('backend.sidebar.slider'))
@section('breadcrumb-info', __('backend.sidebar.slider'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                {!! Form::open(['url' => '/admin/slider', 'class' => 'form-horizontal', 'files' => true]) !!}

                @include ('admin.slider.form', ['formMode' => 'create'])

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
