@extends('layout.admin')

@section('content')
    <div class="page-header">
        <h1>Categories / Edit </h1>
    </div>

    {!! \App\Libs\ErrorDisplay::getInstance()->displayAll($errors) !!}
    <div class="row">
        <div class="col-md-12">

            <form action="{{ action('Admin\CategoryController@update', $category->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$category->id}}</p>
                </div>
                <div class="form-group">
                     <label for="title">TITLE</label>
                     <input type="text" name="title" class="form-control" value="{{ \App\Libs\ValueHelper::getOldInput($category,'title') }}"/>
                     {!! \App\Libs\ErrorDisplay::getInstance()->displayIndividual($errors, "title") !!}
                </div>
                    <div class="form-group">
                        <label for="parent_id">Category Parents</label>
                        {!! Form::select('parent_id', $arrCategories, Session::getOldInput('parent_id') === null ? $category->parent_id : Session::getOldInput('parent_id'), array('class' => 'form-control')) !!}
                     {!! \App\Libs\ErrorDisplay::getInstance()->displayIndividual($errors, "parent_id") !!}
                </div>



            <a class="btn btn-default" href="{{ action('Admin\CategoryController@index') }}">Back</a>
            <button class="btn btn-primary" type="submit" >Save</a>
            </form>
        </div>
    </div>


@endsection