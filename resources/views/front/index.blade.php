@extends('layout.front')

@section('content')
    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Products List
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <!-- Projects Row -->
    @foreach($products->chunk(3) as $chunkProducts)
    <div class="row">
        @foreach($chunkProducts as $product)
        <div class="col-md-4 portfolio-item">
            <h3>
                <a href="#">{{ $product->name }}</a>
            </h3>
            <a href="#">
                <img class="img-responsive" src="{{ $product->photo }}" alt="{{ $product->name }}" width="400px" height="200px">
            </a>
            <p>{{ $product->model }}</p>
        </div>
        @endforeach
    </div>

    @endforeach

    <!-- Pagination -->
    @if($products->count() > PAGINATE_NUM)
    <hr>
    <div class="row text-center">
        <div class="col-lg-12">
            {!! $products->render() !!}
        </div>
    </div>
    @endif
@endsection