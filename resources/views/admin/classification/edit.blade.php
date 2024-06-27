@extends('admin.layouts.master')
@section('title', __('backend.sidebar.classification'))
@section('breadcrumb', __('backend.sidebar.classification'))
@section('breadcrumb-info', __('backend.sidebar.classification'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($classification, [
                        'method' => 'PATCH',
                        'url' => ['/admin/classification', $classification->id],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.classification.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection