<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page | Unaughorized</title>
    <link href="{{ asset('backend/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('backend/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>
<body id="kt_body" class="auth-bg">

    <div class="d-flex flex-column flex-root">

        <div class="d-flex flex-column flex-center flex-column-fluid p-10">

            <h1 class="fw-bold mb-10 text-danger" style="color: #A3A3C7">403 | THIS ACTION IS UNAUTHORIZED</h1>

            <img src="{{ asset('backend/media/no_data.svg') }}" alt="" class="mw-100 mb-10 h-lg-450px" />

            @if (auth()->user()->email == 'laramaster@visibleone.com')
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary"><i class="fa fa-undo"></i> Return Back</a>

            @elseif (auth()->user()->hasRole('Editor') || auth()->user()->hasRole(strtolower('editor')) || auth()->user()->hasRole(strtoupper('editor')))
                <a href="{{ url('admin/home') }}" class="btn btn-secondary"><i class="fa fa-undo"></i> Return Back</a>
            @else
                <a href="{{ route('member.index') }}" class="btn btn-secondary"><i class="fa fa-undo"></i> Return Back</a>
            @endif

        </div>

    </div>

    <script>var hostUrl = "assets/";</script>

    <script src="{{ asset('backend/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('backend/js/scripts.bundle.js') }}"></script>
</body>
</html>