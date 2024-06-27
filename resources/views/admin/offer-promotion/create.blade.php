@extends('admin.layouts.master')
@section('title',  __('backend.sidebar.offer_promotion'))
@section('breadcrumb',  __('backend.sidebar.offer_promotion'))
@section('breadcrumb-info',  __('backend.sidebar.offer_promotion'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                {!! Form::open(['url' => '/admin/offer-promotion', 'class' => 'form-horizontal', 'files' => true]) !!}

                @include ('admin.offer-promotion.form', ['formMode' => 'create'])

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
