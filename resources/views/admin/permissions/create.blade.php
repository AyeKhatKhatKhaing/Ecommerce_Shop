@extends('admin.layouts.master')
@section('title', __('backend.permission.permissions'))
@section('breadcrumb', __('backend.permission.permissions'))
@section('breadcrumb-info', __('backend.permission.create_permission'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                {!! Form::open(['url' => '/admin/permissions', 'class' => 'form-horizontal']) !!}

                @include ('admin.permissions.form', ['formMode' => 'create'])

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection