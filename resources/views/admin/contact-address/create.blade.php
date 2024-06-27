@extends('admin.layouts.master')
@section('title', __('backend.sidebar.contact_address'))
@section('breadcrumb', __('backend.sidebar.contact_address'))
@section('breadcrumb-info', __('backend.sidebar.contact_address'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                {!! Form::open(['url' => '/admin/contact-address', 'class' => 'form-horizontal', 'files' => true]) !!}

                @include ('admin.contact-address.form', ['formMode' => 'create'])

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
