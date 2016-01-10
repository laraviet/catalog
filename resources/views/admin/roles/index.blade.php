@extends('layout.admin')

@section('content')
    <div class="page-header">
        <h1>Roles</h1>
    </div>


    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th class="text-right">OPTIONS</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>

                    <td class="text-right">
                        <a class="btn btn-primary" href="{{ action('Admin\RoleController@show', $role->id) }}">View</a>
                        <a class="btn btn-warning " href="{{ action('Admin\RoleController@edit', $role->id) }}">Edit</a>
                        <form action="{{ action('Admin\RoleController@destroy', $role->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"> <button class="btn btn-danger" type="submit">Delete</button></form>
                    </td>
                </tr>

                @endforeach

                </tbody>
            </table>

            <a class="btn btn-success" href="{{ action('Admin\RoleController@create') }}">Create</a>
        </div>
    </div>


@endsection