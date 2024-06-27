@extends('admin.layouts.master')
@section('title', 'FileManager')
@section('breadcrumb', 'Filemanager')
@section('breadcrumb-info', 'Filemanager List')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-header"></div>
                        <div class="panel-body">
                            <div class="panel panel-inverse">
                                <iframe src="/filemanager"
                                    style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection