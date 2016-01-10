@extends('layout.front')

@section('content')
        <!-- Page Heading/Breadcrumbs -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Product Detail
        </h1>
    </div>
</div>
<!-- /.row -->

<div class="row">

    <div class="col-md-8">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img class="img-responsive" src="{{ $product->photo }}"" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <h3>Name: {{ $product->name }}</h3>
        <p>Model: {{ $product->model }}</p>
    </div>

</div>

@endsection