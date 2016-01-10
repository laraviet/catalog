@extends('layout.admin')

@section('content')
    <div class="page-header">
        <h1>Products / Create </h1>
    </div>

    {!! \App\Libs\ErrorDisplay::getInstance()->displayAll($errors) !!}

    <div class="row">
        <div class="col-md-12">

            <form action="{{ action('Admin\ProductController@store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                     <label for="name">NAME</label>
                     <input type="text" name="name" class="form-control" value="{{  Session::getOldInput('name') }}"/>
                     {!! \App\Libs\ErrorDisplay::getInstance()->displayIndividual($errors, "name") !!}
                </div>
                    <div class="form-group">
                     <label for="photo">PHOTO</label>
                     <input type="text" name="photo" class="form-control" value="{{  Session::getOldInput('photo') }}"/>
                     {!! \App\Libs\ErrorDisplay::getInstance()->displayIndividual($errors, "photo") !!}
                </div>
                    <div class="form-group">
                     <label for="model">MODEL</label>
                     <input type="text" name="model" class="form-control" value="{{  Session::getOldInput('model') }}"/>
                     {!! \App\Libs\ErrorDisplay::getInstance()->displayIndividual($errors, "model") !!}
                </div>



            <a class="btn btn-default" href="{{ action('Admin\ProductController@index') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Create</a>
            </form>
        </div>
    </div>


@endsection