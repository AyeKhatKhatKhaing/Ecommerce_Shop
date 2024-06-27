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

                    {!! Form::model($contactaddress, [
                        'method' => 'PATCH',
                        'url' => ['/admin/contact-address', $contactaddress->id],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.contact-address.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
