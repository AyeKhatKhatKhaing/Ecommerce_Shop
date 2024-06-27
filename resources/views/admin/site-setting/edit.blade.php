@extends('admin.layouts.master')
@section('title',  __('backend.sidebar.site_setting'))
@section('breadcrumb',  __('backend.sidebar.site_setting'))
@section('breadcrumb-info',  __('backend.sidebar.site_setting'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($site_setting, [
                        'method' => 'POST',
                        'url' => ['/admin/site-setting'],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.site-setting.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
