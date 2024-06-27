@extends('admin.layouts.master')
@section('title', __('backend.sidebar.member_type'))
@section('breadcrumb', __('backend.sidebar.member_type'))
@section('breadcrumb-info', __('backend.member_type.create_member_type'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                {!! Form::open(['url' => '/admin/member-type', 'class' => 'form-horizontal', 'files' => true]) !!}

                @include ('admin.member-type.form', ['formMode' => 'create'])

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
