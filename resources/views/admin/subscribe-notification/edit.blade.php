@extends('admin.layouts.master')
@section('title', __('backend.sidebar.notification'))
@section('breadcrumb', __('backend.sidebar.notification'))
@section('breadcrumb-info', __('backend.sidebar.notification'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($subscribenotification, [
                        'method' => 'POST',
                        'url' => ['/admin/subscribe-notification'],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.subscribe-notification.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
