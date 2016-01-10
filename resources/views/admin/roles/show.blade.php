@extends('layout.admin')

@section('content')
    <div class="page-header">
        <h1>Roles / Show </h1>
    </div>


    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$role->id}}</p>
                </div>
                <div class="form-group">
                     <label for="name">NAME</label>
                     <p class="form-control-static">{{$role->name}}</p>
                </div>
            </form>



            <a class="btn btn-default" href="{{ action('Admin\RoleController@index') }}">Back</a>
            <a class="btn btn-warning" href="{{ action('Admin\RoleController@edit', $role->id) }}">Edit</a>
            <form action="{{ action('Admin\RoleController@destroy', $role->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button class="btn btn-danger" type="submit">Delete</button></form>
        </div>
    </div>


@endsection