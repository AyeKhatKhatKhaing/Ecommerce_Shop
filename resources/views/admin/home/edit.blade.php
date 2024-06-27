@extends('admin.layouts.master')
@section('title', __('backend.sidebar.home'))
@section('breadcrumb', __('backend.sidebar.home'))
@section('breadcrumb-info', __('backend.sidebar.home'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($home, [
                        'method' => 'POST',
                        'url' => ['/admin/home'],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.home.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
