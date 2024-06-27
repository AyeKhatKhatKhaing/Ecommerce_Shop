@extends('admin.layouts.master')
@section('title', __('backend.sidebar.member_exclusive_offer_page'))
@section('breadcrumb', __('backend.sidebar.member_exclusive_offer_page'))
@section('breadcrumb-info', __('backend.sidebar.member_exclusive_offer_page'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row mx-1">
                    @if ($errors->any())
                        <x-errors :errors="$errors" />
                    @endif
                </div>

                    {!! Form::model($memberexclusiveoffer, [
                        'method' => 'POST',
                        'url' => ['/admin/member-exclusive-offer'],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.member-exclusive-offer.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
