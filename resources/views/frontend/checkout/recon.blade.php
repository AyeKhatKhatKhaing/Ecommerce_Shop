@extends('frontend.layouts.master')
@section('content')
<form action="<?php echo $url ?>" method="post" id="recon-form"></form>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $("#recon-form").submit();
    });
</script>
@endpush