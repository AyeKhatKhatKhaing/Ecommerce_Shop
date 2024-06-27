@extends('admin.layouts.master')
@section('title',  __('backend.sidebar.common_problem'))
@section('breadcrumb',  __('backend.sidebar.common_problem'))
@section('breadcrumb-info',  __('backend.sidebar.common_problem'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($commonproblem, [
                        'method' => 'POST',
                        'url' => ['/admin/common-problem'],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.common-problem.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
