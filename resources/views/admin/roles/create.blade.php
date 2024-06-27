@extends('admin.layouts.master')
@section('title', __('backend.role.roles'))
@section('breadcrumb', __('backend.role.roles'))
@section('breadcrumb-info', __('backend.role.create_role'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                {!! Form::open(['url' => '/admin/roles', 'class' => 'form-horizontal']) !!}

                @include ('admin.roles.form', ['formMode' => 'create'])

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
