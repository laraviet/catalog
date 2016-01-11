@extends('layout.admin')

@section('content')
    <div class="page-header">
        <div class="row">
            <h1>Products
                <li class="dropdown pull-right" style="list-style: none">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><h3>Select Category</h3> </a>
                    <ul class="dropdown-menu">
                        @foreach($allCategories as $category)
                            <li><a href="{{ action('Admin\ProductController@dashboardCat', $category['id']) }}">{{ $category['title'] }}</a></li>
                        @endforeach
                    </ul>
                </li>
            </h1>

        </div>

        @if (Session::has('message'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ Session::get('message') }}
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Model</th>
                        <th>Categories</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td><img src={{$product->photo}} class="img-responsive" alt="{{ $product->name }}" width="150" height="150"> </td>
                    <td>{{$product->model}}</td>
                    <td>{{$product->getCategoryOfProduct()}}</td>
                </tr>

                @endforeach

                </tbody>
            </table>

            <div>
                {!! $products->render() !!}
            </div>

        </div>
    </div>


@endsection