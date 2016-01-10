@extends('layout.admin')

@section('content')
    <div class="page-header">
        <h1>Products / Show </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">Id</label>
                    <p class="form-control-static">{{$product->id}}</p>
                </div>
                <div class="form-group">
                     <label for="name">Name</label>
                     <p class="form-control-static">{{$product->name}}</p>
                </div>
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <img src={{$product->photo}} class="img-responsive" alt="{{ $product->name }}" width="150" height="150">
                </div>
                <div class="form-group">
                     <label for="model">Model</label>
                     <p class="form-control-static">{{$product->model}}</p>
                </div>
                <div class="form-group">
                    <label for="model">Categories</label>
                    <p class="form-control-static">{{$product->getCategoryOfProduct()}}</p>
                </div>
            </form>



            <a class="btn btn-default" href="{{ action('Admin\ProductController@index') }}">Back</a>
            <a class="btn btn-warning" href="{{ action('Admin\ProductController@edit', $product->id) }}">Edit</a>
            <form action="{{ action('Admin\ProductController@destroy', $product->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button class="btn btn-danger" type="submit">Delete</button></form>
        </div>
    </div>


@endsection