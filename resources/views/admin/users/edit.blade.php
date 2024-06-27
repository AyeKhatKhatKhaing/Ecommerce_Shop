@extends('admin.layouts.master')
@section('title', __('backend.user.users'))
@section('breadcrumb', __('backend.user.users'))
@section('breadcrumb-info', __('backend.user.edit_user'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                {!! Form::model($user, [
                    'method' => 'PATCH',
                    'url' => ['/admin/users', $user->id],
                    'class' => 'form-horizontal'
                ]) !!}

                @include ('admin.users.form', ['formMode' => 'edit'])

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
