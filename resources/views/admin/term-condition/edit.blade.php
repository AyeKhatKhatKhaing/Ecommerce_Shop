@extends('admin.layouts.master')
@section('title', __('backend.sidebar.term_condition'))
@section('breadcrumb', __('backend.sidebar.term_condition'))
@section('breadcrumb-info', __('backend.sidebar.term_condition'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($termcondition, [
                        'method' => 'POST',
                        'url' => ['/admin/term-condition'],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.term-condition.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
