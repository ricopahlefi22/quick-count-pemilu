<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Error 500 | Quixx</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="home-btn d-none d-sm-block">
        <a href="{{ url('/') }}" class="text-white"><i class="fas fa-home h2"></i></a>
    </div>

    <div class="my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="logo" height="24" />
                        </a>
                        <div class="row justify-content-center mt-5">
                            <div class="col-sm-4">
                                <div class="maintenance-img">
                                    <img src="{{ asset('assets/images/error-img.png') }}" alt=""
                                        class="img-fluid mx-auto d-block">
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-4">500</h1>
                        <h4 class="mt-2">Server Bermasalah</h4>
                        <p class="text-muted">Harap tunggu beberapa saat lagi atau tanyakan permasalahan pada pengembang aplikasi.</p>

                        <a href="{{ url()->previous() }}" class="btn btn-primary">
                            <i class="fa fa-arrow-circle-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
