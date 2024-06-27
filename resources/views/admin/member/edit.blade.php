@extends('admin.layouts.master')
@section('title', __('backend.sidebar.member'))
@section('breadcrumb', __('backend.sidebar.member'))
@section('breadcrumb-info', __('backend.sidebar.member'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($member, [
                        'method' => 'PATCH',
                        'url' => ['/admin/member', $member->id],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.member.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
