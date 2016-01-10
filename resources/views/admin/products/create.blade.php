@extends('layout.admin')

@section('content')
    <div class="page-header">
        <h1>Products / Create </h1>
    </div>

    {!! \App\Libs\ErrorDisplay::getInstance()->displayAll($errors) !!}

    <div class="row">
        <div class="col-md-12">

            <form action="{{ action('Admin\ProductController@store') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" name="name" class="form-control" value="{{  Session::getOldInput('name') }}"/>
                     {!! \App\Libs\ErrorDisplay::getInstance()->displayIndividual($errors, "name") !!}
                </div>

                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" name="model" class="form-control" value="{{  Session::getOldInput('model') }}"/>
                    {!! \App\Libs\ErrorDisplay::getInstance()->displayIndividual($errors, "model") !!}
                </div>

                <div class="form-group">
                    <label for="category_id">Categories</label>
                    {!! Form::select('category_id[]', $endChildCategories, Session::getOldInput('category_id[]'), array('class' => 'form-control categories', 'multiple' => 'multiple')) !!}
                    {!! \App\Libs\ErrorDisplay::getInstance()->displayIndividual($errors, "category_id[]") !!}
                </div>

                <div class="form-group">
                     <label for="photo">Photo</label>
                     {!! Form::file('photo') !!}
                     {!! \App\Libs\ErrorDisplay::getInstance()->displayIndividual($errors, "photo") !!}
                </div>


                <a class="btn btn-default" href="{{ action('Admin\ProductController@index') }}">Back</a>
                <button class="btn btn-primary" type="submit" >Create</button>
            </form>
        </div>
    </div>


@endsection

@section('script_close')

@endsection