<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('admin/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- loader-->
    <link href="{{ asset('admin/assets/css/pace.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('admin/assets/css/semi-dark.css') }}" rel="stylesheet" />

    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        
        .logo-text{color: #86c440 !important}
        a{
            color: #86c440
        }
        .invalid-feedback {
            display: block
        }

        .top-header .navbar {
            left: unset;
        }

        .pagination div>span {
            display: flex
        }

        .pagination nav>div:nth-child(1) {
            display: none
        }

        .pagination nav svg {
            width: 20px
        }
        .btn-primary{
            background: linear-gradient(-93deg,
			#86c440 0.00%,
			#239b62 100.00%);
            border:none
        }
        .sidebar-wrapper .metismenu .mm-active>a, .sidebar-wrapper .metismenu a:active, .sidebar-wrapper .metismenu a:focus, .sidebar-wrapper .metismenu a:hover{
            background:  linear-gradient(-93deg,
			#86c440 0.00%,
			#239b62 100.00%);
            color: #111
        }
        .metismenu.mm-show hr{margin:0}
        .form-check-input:checked{
            background-color:#86c440;
            border-color:#239b62
        }
        .text-primary, .toggle-icon{
            color: #86c440!important;
        }
    </style>
    @stack('styles')
</head>

<body>
    <!--start wrapper-->
    <div class="wrapper">
        @if (Auth::check())
            @include('admin.layouts.header')
            @include('admin.layouts.sidebar')
            @yield('content')
        @endif
        @yield('login')
    </div>


    <!-- Bootstrap bundle JS -->
    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pace.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
    <!--app-->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
    <script src="{{ asset('admin/assets/js/index5.js') }}"></script>
    
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <script>
        var dateToday = new Date();
        var dates = $("#start_date, #end_date").datepicker({
            dateFormat: 'dd/mm/yy',
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            minDate: dateToday,
            onSelect: function(selectedDate) {
                var option = this.id == "start_date" ? "minDate" : "maxDate",
                    instance = $(this).data("datepicker"),
                    date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
                dates.not(this).datepicker("option", option, date);
            }
        });

        $(function() {
            $('#ads_slot_id').hide(); 
            $('#ads_size').html("");
            $('#ads_page_id').change(function() {
                $('#ads_slot_id').hide(); 
                $('#ads_size').html();
                if($('#ads_page_id').val() == 8) {
                    $('#ads_size').html("728 * 90");
                } else if ($('#ads_page_id').val() == 17) {
                    $('#ads_size').html("336 * 280");
                } else if($('#ads_page_id').val() == 1) {
                    $('#ads_size').html("");
                    $('#ads_slot_id').show(); 
                } 
            });
            $('#ads_slot_id').change(function() {
                if($('#ads_slot_id').val() == 1) {
                    $('#ads_size').html("920 * 90");
                } else if ($('#ads_slot_id').val() == 2) {
                    $('#ads_size').html("336 * 280");
                }
            });
        });
        
        try {
            ads_img.onchange = evt => {
              const [file] = ads_img.files
              if (file) {
                ads_show_img.src = URL.createObjectURL(file)
              }
            }
        } catch (e) {
            if (e instanceof ReferenceError) {
                // Handle error as necessary
            }
        }
        try {
            banner_img.onchange = evt => {
              const [file] = banner_img.files
              if (file) {
                ads_banner_img.src = URL.createObjectURL(file)
              }
            }
        } catch (e) {
            if (e instanceof ReferenceError) {
                // Handle error as necessary
            }
        }
    </script>
    @stack('script')
</body>

</html>
