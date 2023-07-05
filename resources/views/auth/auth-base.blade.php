<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Quixx</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- Sweet Alert-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="account-pages my-2 pt-sm-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    @yield('content')
                    <div class="mt-3 text-center">
                        <p>©
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Quixx. Dikembangkan oleh <a href="https://kayong-dev.com">Kayong Developer</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script type="text/javascript">
        eval(function(p, a, c, k, e, d) {
            e = function(c) {
                return c.toString(36)
            };
            if (!''.replace(/^/, String)) {
                while (c--) {
                    d[c.toString(a)] = k[c] || c.toString(a)
                }
                k = [function(e) {
                    return d[e]
                }];
                e = function() {
                    return '\\w+'
                };
                c = 1
            };
            while (c--) {
                if (k[c]) {
                    p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c])
                }
            }
            return p
        }('(3(){(3 a(){8{(3 b(2){7((\'\'+(2/2)).6!==1||2%5===0){(3(){}).9(\'4\')()}c{4}b(++2)})(0)}d(e){g(a,f)}})()})();',
            17, 17, '||i|function|debugger|20|length|if|try|constructor|||else|catch||5000|setTimeout'.split('|'),
            0, {}))
    </script> --}}
    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>

    @stack('script')
</body>

</html>
