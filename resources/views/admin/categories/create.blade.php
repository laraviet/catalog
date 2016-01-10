@extends('layout.admin')

@section('content')
    <div class="page-header">
        <h1>Categories / Create </h1>
    </div>

    {!! \App\Libs\ErrorDisplay::getInstance()->displayAll($errors) !!}

    <div class="row">
        <div class="col-md-12">

            <form action="{{ action('Admin\CategoryController@store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{  Session::getOldInput('title') }}"/>
                    {!! \App\Libs\ErrorDisplay::getInstance()->displayIndividual($errors, "title") !!}
                </div>
                <div class="form-group">
                    <label for="parent_id">Category Parents</label>
                    {!! Form::select('parent_id', $arrCategories, Session::getOldInput('parent_id'), array('class' => 'form-control')) !!}
                    {!! \App\Libs\ErrorDisplay::getInstance()->displayIndividual($errors, "parent_id") !!}
                </div>

            <a class="btn btn-default" href="{{ action('Admin\CategoryController@index') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Create</a>
            </form>
        </div>
    </div>


@endsection