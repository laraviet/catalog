<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>LARAVEL 5 ADMIN</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('admins/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admins/css/select2.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('admins/css/sb-admin.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('admins/css/plugins/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('admins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('admins/css/main.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('css_open')
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Catalog</a>
                <ul class="nav navbar-nav">

                </ul>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                        {{ getAuthUsername() }}
                     <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ action('Auth\AuthController@getLogout') }}"><i class="fa fa-fw fa-user"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    @can('manage_categories')
                    <li>
                        <a href="{{ action('Admin\ProductController@dashboard') }}"><i class="fa fa-fw fa-dashboard"></i>DashBoards</a>
                    </li>
                    <li>
                        <a href="{{ action('Admin\CategoryController@index') }}"><i class="fa fa-fw fa-dashboard"></i>Category Management</a>
                    </li>
                    @endcan
                    @can('manage_products')
                    <li>
                        <a href="{{ action('Admin\ProductController@index') }}"><i class="fa fa-fw fa-dashboard"></i>Product Management</a>
                    </li>
                    @endcan
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        @yield('content')
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('admins/js/jquery.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('admins/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admins/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".categories").select2();

            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 2000);
        });
    </script>
    @yield('script_close')
</body>
</html>
