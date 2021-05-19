<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yawatmalkar - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ================= Favicon ================== -->
    @include('auth.auth_layout.stylesheet')

    @yield('customcss')
    <style>
    .myClickableThingy {
        cursor: pointer;
    }
    </style>
</head>

<body>

    @include('auth.auth_layout.sidebar')
    <!-- /# sidebar -->

    @include('auth.auth_layout.topbar')


    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>@yield('page_title')</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    @yield('content')
                </section>
            </div>
        </div>
    </div>

    @include('auth.auth_layout.scripts')
    @yield('customjs')
</body>

</html>