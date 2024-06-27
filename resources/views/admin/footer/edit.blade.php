@extends('admin.layouts.master')
@section('title', __('backend.sidebar.footer'))
@section('breadcrumb', __('backend.sidebar.footer'))
@section('breadcrumb-info', __('backend.sidebar.footer'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($footer, [
                        'method' => 'POST',
                        'url' => ['/admin/footer'],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.footer.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
