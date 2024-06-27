@extends('admin.layouts.master')
@section('title', __('backend.sidebar.exclusive_offer'))
@section('breadcrumb', __('backend.sidebar.exclusive_offer'))
@section('breadcrumb-info', __('backend.sidebar.exclusive_offer'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($exclusiveoffer, [
                        'method' => 'PATCH',
                        'url' => ['/admin/exclusive-offer', $exclusiveoffer->id],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.exclusive-offer.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection