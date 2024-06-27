@extends('admin.layouts.master')
@section('title',  __('backend.sidebar.coupon'))
@section('breadcrumb',  __('backend.sidebar.coupon'))
@section('breadcrumb-info',  __('backend.sidebar.coupon'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($coupon, [
                        'method' => 'PATCH',
                        'url' => ['/admin/coupon', $coupon->id],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.coupon.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
