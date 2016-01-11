@extends('layout.admin')

@section('content')
<style type="text/css">
    a:link {
        color: blue;
        background-color: transparent;
        text-decoration: none;
        font-size: 24px;
    }
</style>

    <div class="container">
        <div class="content">
            <div class="error" style="font-size: 62px;">403 Forbidden.</div>
            <a href="{{ action('Admin\ProductController@dashboard') }}">Back</a>
        </div>
    </div>
@endsection
