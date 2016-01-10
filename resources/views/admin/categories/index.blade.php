@extends('layout.admin')

@section('content')
    <div class="page-header">
        <h1>Categories</h1>
    </div>


    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TITLE</th>
                        <th>Category Parent</th>
                        <th class="text-right">OPTIONS</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->title}}</td>
                    <td>{{$category->getCategoryTitle($category->parent_id)}}</td>

                    <td class="text-right">
                        <a class="btn btn-primary" href="{{ action('Admin\CategoryController@show', $category->id) }}">View</a>
                        <a class="btn btn-warning " href="{{ action('Admin\CategoryController@edit', $category->id) }}">Edit</a>
                        <form action="{{ action('Admin\CategoryController@destroy', $category->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>
                    </td>
                </tr>

                @endforeach

                </tbody>
            </table>

            <a class="btn btn-success" href="{{ action('Admin\CategoryController@create') }}">Create</a>
        </div>
    </div>


@endsection