@extends('admin.layouts.master')
@section('title', __('backend.sidebar.about_remfly'))
@section('breadcrumb', __('backend.sidebar.about_remfly'))
@section('breadcrumb-info', __('backend.sidebar.about_remfly'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($aboutremfly, [
                        'method' => 'POST',
                        'url' => ['/admin/about-remfly'],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.about-remfly.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
