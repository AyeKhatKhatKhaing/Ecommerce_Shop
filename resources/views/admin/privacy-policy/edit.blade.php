@extends('admin.layouts.master')
@section('title', __('backend.sidebar.privacy_policy'))
@section('breadcrumb', __('backend.sidebar.privacy_policy'))
@section('breadcrumb-info', __('backend.sidebar.privacy_policy'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($privacypolicy, [
                        'method' => 'POST',
                        'url' => ['/admin/privacy-policy'],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.privacy-policy.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
