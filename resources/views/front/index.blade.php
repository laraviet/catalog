@extends('layout.front')

@section('content')
    <div class="col-lg-12">
        <h2 class="page-header">Products List</h2>
    </div>

    @foreach($products->chunk(3) as $chunkProducts)
    <div class="row">
        @foreach($chunkProducts as $product)
            <div class="col-md-4 col-sm-6">
                <h3>
                    <a href="#">{{ $product->name }}</a>
                </h3>
                <a href="#">
                    <img class="img-responsive img-portfolio img-hover" src="{{ $product->photo }}" alt="{{ $product->name }}" width="400px" height="200px">
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