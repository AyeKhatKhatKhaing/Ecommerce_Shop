@extends('admin.layouts.master')
@section('title', __('backend.sidebar.member_type'))
@section('breadcrumb', __('backend.sidebar.member_type'))
@section('breadcrumb-info', __('backend.member_type.edit_member_type'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($membertype, [
                        'method' => 'PATCH',
                        'url' => ['/admin/member-type', $membertype->id],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.member-type.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
