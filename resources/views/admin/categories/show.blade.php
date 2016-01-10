@extends('layout.admin')

@section('content')
    <div class="page-header">
        <h1>Categories / Show </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">Id</label>
                    <p class="form-control-static">{{$category->id}}</p>
                </div>
                <div class="form-group">
                     <label for="title">Title</label>
                     <p class="form-control-static">{{$category->title}}</p>
                </div>
                    <div class="form-group">
                     <label for="parent_id">Category Parent</label>
                     <p class="form-control-static">{{$category->getCategoryTitle($category->parent_id)}}</p>
                </div>
            </form>



            <a class="btn btn-default" href="{{ action('Admin\CategoryController@index') }}">Back</a>
            <a class="btn btn-warning" href="{{ action('Admin\CategoryController@edit', $category->id) }}">Edit</a>
            <form action="{{ action('Admin\CategoryController@destroy', $category->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button class="btn btn-danger" type="submit">Delete</button></form>
        </div>
    </div>


@endsection