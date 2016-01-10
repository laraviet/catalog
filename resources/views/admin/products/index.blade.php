@extends('layout.admin')

@section('content')
    <div class="page-header">
        <h1>Products</h1>

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
                        <th class="text-right">OPTIONS</th>
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

                    <td class="text-right">
                        <a class="btn btn-primary" href="{{ action('Admin\ProductController@show', $product->id) }}">View</a>
                        <a class="btn btn-warning " href="{{ action('Admin\ProductController@edit', $product->id) }}">Edit</a>
                        <form action="{{ action('Admin\ProductController@destroy', $product->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>
                    </td>
                </tr>

                @endforeach

                </tbody>
            </table>

            <div>
                {!! $products->render() !!}
            </div>

            <a class="btn btn-success" href="{{ action('Admin\ProductController@create') }}">Create</a>
        </div>
    </div>


@endsection