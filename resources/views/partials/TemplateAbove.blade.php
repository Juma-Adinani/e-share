<!DOCTYPE html>
<html lang="en">
@if(!session('id'))
<script>
    window.location.href = "/login";
</script>
@endif

@include('partials._head_tag')

<body>
    <div class="container-scroller">
        @include('partials._navbar')
        <div class="container-fluid page-body-wrapper">
            @include('partials._sidebar') <div class="main-panel">
                <div class="content-wrapper">
