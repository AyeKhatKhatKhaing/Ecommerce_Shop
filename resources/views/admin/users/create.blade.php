@extends('admin.layouts.master')
@section('title', __('backend.user.users'))
@section('breadcrumb', __('backend.user.users'))
@section('breadcrumb-info', __('backend.user.create_user'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                {!! Form::open(['url' => '/admin/users', 'class' => 'form-horizontal']) !!}

                @include ('admin.users.form', ['formMode' => 'create'])

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
