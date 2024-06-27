@extends('admin.layouts.master')
@section('title', __('backend.sidebar.contact_page'))
@section('breadcrumb', __('backend.sidebar.contact_page'))
@section('breadcrumb-info', __('backend.sidebar.contact_page'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($contactpage, [
                        'method' => 'POST',
                        'url' => ['/admin/contact-page'],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.contact-page.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
