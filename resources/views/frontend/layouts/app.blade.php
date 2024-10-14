<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>{{ $metaTags['title'] }}</title>
    <meta name="title" content="{{ $metaTags['title'] }}">
    <meta name="description" content="{{ $metaTags['description'] }}">
    <meta name="keywords" content="{{ $metaTags['keywords'] }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Carjock') }}</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/dragula.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <script>
        var baseURL = "{{ url('/') }}";
        var siteurl = "{{ asset('/') }}";
    </script>
    <script>
        var favourite_url = "{{ route('frontend.favourite') }}";
        var save_compare_url = "{{ route('frontend.savecomparisions') }}";
        var auth_user_id = "{{ Auth::check() ? auth()->user()->id : '' }}";
    </script>
    <script type="text/javascript"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=6536d1fb514dad0019b7f1f4&product=inline-share-buttons&source=platform"
        async="async"></script>
    @stack('styles')
    <style>
        /* Define initial state for hidden elements */
        .page-content {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        /* Define visible state */
        .page-content.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .hidesocial {
            display: none;
            background: #fff;
            padding: 20px 10px;
            margin-top: 10px;
            position: relative
        }

        .hidesocial .st-btn {
            display: inline-block !important;
        }

        .closesocial {
            position: absolute;
            top: 5px;
            right: 10px
        }

        .social-share-links div {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            -moz-transition: opacity 0.2s ease-in, top 0.2s ease-in;
            -ms-transition: opacity 0.2s ease-in, top 0.2s ease-in;
            -o-transition: opacity 0.2s ease-in, top 0.2s ease-in;
            -webkit-transition: opacity 0.2s ease-in, top 0.2s ease-in;
            transition: opacity 0.2s ease-in, top 0.2s ease-in;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            display: inline-block;
            font-size: 16px;
            margin-right: 8px;
            padding: 12px;
            position: relative;
            text-align: center;
            top: 0;
            vertical-align: top;
            white-space: nowrap;
            color: #fff;
        }

        .social-share-links div img {
            width: 25px;
        }

        .social-share-links .facebook {
            background-color: #4267B2;

        }

        .social-share-links .twitter {
            background-color: #000000;
        }

        .social-share-links .email {
            background-color: #7d7d7d;
        }
    </style>
</head>

<body>
    @if (isset($class) && ($class === 'login' || $class === 'contact_us'))
        <section class="{{ $class }}">
    @endif
    @include('frontend.layouts.header')
    <div class="page-content" id="pageContent">
        @yield('content')
    </div>

    @include('frontend.layouts.footer')

    <div class="modal fade" style="margin-top:15%" id="login-alert" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    You need to login to proceed.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <a href="{{ route('frontend.login') }}" class="btn btn-success">Login</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('frontend/assets/js/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.0/lity.min.js"></script>
    <script src="{{ asset('frontend/assets/js/dragula.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>


    <script>
        $(document).ready(function() {
            // Add visible class to the content when the page is loaded
            $('#pageContent').addClass('visible');
        });
        new WOW().init();
        $(document).on("click", '.showsocial', function(event) {
            $('.hidesocial').stop(true, true).show(400);
            event.stopPropagation(); // Prevent the click event from propagating to the document
        });

        $(document).on("click", function(event) {
            if (!$(event.target).closest('.hidesocial').length) {
                $('.hidesocial').stop(true, true).hide(400);
            }
        });

        $('.closesocial').click(function() {
            $('.hidesocial').stop(true, true).hide(400);
        });


        $(document).on("click", '.socialshare', function(e) {
            e.stopPropagation(); // Prevent click event from propagating to parent elements
            $('.socialshare-detail.hidesocial').hide(); // Hide all other social share details
            $(this).parent().parent().parent().find('.socialshare-detail.hidesocial').stop(true, true).show(400);
        });

        // Function to close social share detail
        $(document).on("click", '.socialshare .close', function(e) {
            e.stopPropagation(); // Prevent click event from propagating to parent elements
            $(this).parent().parent().parent().find('.socialshare-detail.hidesocial').stop(true, true).hide(400);
        });

        // Function to close social share detail when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.socialshare-detail').length && !$(e.target).closest('.socialshare').length) {
                $('.socialshare-detail.hidesocial').stop(true, true).hide(400);
            }
        });
    </script>
    @stack('script')
</body>

</html>
