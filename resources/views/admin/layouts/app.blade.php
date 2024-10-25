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
    <script>
        var baseURL = "{{ url('/') }}";
        var siteurl = "{{ asset('/') }}";
    </script>
    <style>
        .logo-text {
            color: #86c440 !important
        }

        a {
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

        .btn-primary {
            background: linear-gradient(-93deg,
                    #86c440 0.00%,
                    #239b62 100.00%);
            border: none
        }

        .sidebar-wrapper .metismenu .mm-active>a,
        .sidebar-wrapper .metismenu a:active,
        .sidebar-wrapper .metismenu a:focus,
        .sidebar-wrapper .metismenu a:hover {
            background: linear-gradient(-93deg,
                    #86c440 0.00%,
                    #239b62 100.00%);
            color: #111
        }

        .metismenu.mm-show hr {
            margin: 0
        }

        .form-check-input:checked {
            background-color: #86c440;
            border-color: #239b62
        }

        .text-primary,
        .toggle-icon {
            color: #86c440 !important;
        }

        .preloader {
            display: none;
        }

        .loaderWrapper {
            position: fixed;
            top: 0;
            width: 100%;
            height: 100%;
            background: #ffffff80;
            z-index: 1000;
            pointer-events: none;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader {
            display: flex;
            flex-direction: row;
            align-items: center;
            z-index: 999;
        }

        .loader .bar {
            width: 10px;
            height: 5px;
            background: #49a94d;
            margin: 2px;
            animation: bar 1s infinite linear;
        }

        .loader .bar:nth-child(1) {
            animation-delay: 0s;
        }

        .loader .bar:nth-child(2) {
            animation-delay: 0.25s;
        }

        .loader .bar:nth-child(3) {
            animation-delay: 0.5s;
        }

        @keyframes bar {
            0% {
                transform: scaleY(1) scaleX(0.5);
            }

            50% {
                transform: scaleY(10) scaleX(1);
            }

            100% {
                transform: scaleY(1) scaleX(0.5);
            }
        }

        @keyframes fadeLoader {
            to {
                opacity: 0;
            }
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
            <div class="preloader">
                <div class="loaderWrapper">
                    <div class="loader">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </div>
                </div>
            </div>
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
                    date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults
                        .dateFormat, selectedDate, instance.settings);
                dates.not(this).datepicker("option", option, date);
            }
        });

        $(function() {
            $('#ads_slot_id').hide();
            $('#ads_size').html("");
            $('#ads_page_id').change(function() {
                $('#ads_slot_id').hide();
                $('#ads_size').html();
                if ($('#ads_page_id').val() == 8) {
                    $('#ads_size').html("728 * 90");
                } else if ($('#ads_page_id').val() == 17) {
                    $('#ads_size').html("336 * 280");
                } else if ($('#ads_page_id').val() == 1) {
                    $('#ads_size').html("");
                    $('#ads_slot_id').show();
                }
            });
            $('#ads_slot_id').change(function() {
                if ($('#ads_slot_id').val() == 1) {
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

    <script>
        $(document).ready(function() {
            // Handle year change to update divisions
            $('#year').change(function() {
                let selectedYear = $(this).val();
                if (selectedYear) {
                    $.ajax({
                        url: baseURL + '/admin/api/divisions', // API route to fetch divisions
                        method: 'GET',
                        data: {
                            year: selectedYear
                        }, // Send the selected year as data
                        success: function(response) {
                            let divisionDropdown = $('#division');
                            let modelDropdown = $(
                                '#model'); // Assuming this is your model dropdown
                            let styleDropdown = $(
                                '#style'); // Assuming this is your style dropdown
                            let modelCountLabel = $(
                                '#model-count'
                            ); // Assuming there's a label or element to display the model count
                            let styleCountLabel = $(
                                '#style-count'
                            ); // Assuming there's a label or element to display the style count

                            divisionDropdown.empty(); // Clear previous options
                            modelDropdown.empty(); // Clear previous model options
                            styleDropdown.empty(); // Clear previous style options
                            modelCountLabel.text(''); // Reset model count label
                            styleCountLabel.text(''); // Reset style count label

                            if (response.divisions.length > 0) {
                                divisionDropdown.append(
                                    '<option value="all">All Divisions</option>'
                                ); // Default option

                                $.each(response.divisions, function(key, division) {
                                    divisionDropdown.append('<option value="' + division
                                        .id + '">' + division.name + '</option>');
                                });

                                $('#division-count').text('Divisions available: ' + response
                                    .divisions.length);
                                $('#update-vehicle').show();

                                // Reset models and styles if divisions are available
                                modelDropdown.append('<option value="all">All Models</option>');
                                styleDropdown.append(
                                    '<option selected value="all">All Styles</option>');

                                // Now send AJAX request to fetch all models for the selected year with division_id = 'all'
                                $.ajax({
                                    url: baseURL +
                                        '/admin/api/models', // API route to fetch models
                                    method: 'GET',
                                    data: {
                                        year: selectedYear,
                                        division_id: 'all'
                                    }, // Send the selected year and division_id 'all'
                                    success: function(modelResponse) {
                                        if (modelResponse.models.length > 0) {
                                            $.each(modelResponse.models, function(
                                                key, model) {
                                                modelDropdown.append(
                                                    '<option value="' +
                                                    model.id + '">' +
                                                    model.name +
                                                    '</option>');
                                            });

                                            // Update the model count
                                            modelCountLabel.text(
                                                'Models available: ' +
                                                modelResponse.models.length);
                                        } else {
                                            modelDropdown.append(
                                                '<option value="">No Models Available</option>'
                                            );
                                            modelCountLabel.text(
                                                'No models available.');
                                        }

                                        // Fetch styles based on the selected year with division_id = 'all'
                                        $.ajax({
                                            url: baseURL +
                                                '/admin/api/styles', // API route to fetch styles
                                            method: 'GET',
                                            data: {
                                                year: selectedYear,
                                                model_id: 'all',
                                                division_id: 'all'
                                            },
                                            success: function(
                                                styleResponse) {
                                                if (styleResponse.styles
                                                    .length > 0) {
                                                    $.each(styleResponse
                                                        .styles,
                                                        function(
                                                            key,
                                                            style) {
                                                            styleDropdown
                                                                .append(
                                                                    '<option value="' +
                                                                    style
                                                                    .id +
                                                                    '">' +
                                                                    style
                                                                    .name +
                                                                    '</option>'
                                                                );
                                                        });
                                                    // Update the style count
                                                    styleCountLabel
                                                        .text(
                                                            'Styles available: ' +
                                                            styleResponse
                                                            .styles
                                                            .length);
                                                } else {
                                                    styleDropdown
                                                        .append(
                                                            '<option value="">No Styles Available</option>'
                                                        );
                                                    styleCountLabel
                                                        .text(
                                                            'No styles available.'
                                                        );
                                                }
                                            },
                                            error: function() {
                                                alert(
                                                    'Error fetching styles. Please try again.'
                                                );
                                            }
                                        });
                                    },
                                    error: function() {
                                        alert(
                                            'Error fetching models. Please try again.'
                                        );
                                    }
                                });

                            } else {
                                // If no divisions are found, display "No Divisions Available"
                                divisionDropdown.append(
                                    '<option value="">No Divisions Available</option>');
                                $('#division-count').text('No divisions available.');
                                $('#update-divisions').show();

                                // Update models and styles dropdowns to "No Models Available" and "No Styles Available"
                                modelDropdown.append(
                                    '<option value="">No Models Available</option>');
                                styleDropdown.append(
                                    '<option value="">No Styles Available</option>');
                            }
                        },
                        error: function() {
                            alert('Error fetching divisions. Please try again.');
                        }
                    });
                } else {
                    // Reset divisions, models, and styles to default if no year is selected
                    $('#division').html('<option value="all">All Divisions</option>');
                    $('#division-count').text('');
                    $('#model').html('<option value="">No Models Available</option>');
                    $('#style').html('<option value="">No Styles Available</option>');
                    $('#model-count').text(''); // Reset model count label
                    $('#style-count').text(''); // Reset style count label
                }
            });




            // Handle division change to update models
            $('#division').change(function() {
                let divisionId = $(this).val();
                let selectedYear = $('#year option:selected').val();
                let selectedDivisionName = $('#division option:selected')
                    .text(); // Get the selected division's name
                let modelSelect = $('#model');
                modelSelect.empty(); // Clear existing options

                $.ajax({
                    url: baseURL + '/admin/api/models', // API route to fetch models
                    method: 'GET',
                    data: {
                        division_id: divisionId,
                        year: selectedYear
                    },
                    success: function(response) {
                        // Check if models are available
                        if (response.models.length > 0) {
                            modelSelect.append('<option value="all">All Models</option>');
                            $.each(response.models, function(key, model) {
                                modelSelect.append('<option value="' + model.id + '">' +
                                    model.name + '</option>');
                            });
                            $('#model-count').text('Models available: ' + response.models
                                .length);
                        } else {
                            modelSelect.append(
                                '<option value="all">No Models Available</option>');
                            $('#model-count').text('No models available.');
                            $('#update-models')
                                .show(); // Show the button if no models are found
                        }
                    },
                    error: function() {
                        alert('Error fetching models. Please try again.');
                    }
                });
            });

            // Handle model change to update styles
            $('#model').change(function() {
                let modelId = $(this).val();
                let selectedYear = $('#year option:selected').val();
                let selectedModelName = $('#model option:selected').text(); // Get the selected model's name
                let selectedDivisionId = $('#division option:selected')
                    .val(); // Get the selected model's name

                $.ajax({
                    url: baseURL + '/admin/api/styles', // API route to fetch styles
                    method: 'GET',
                    data: {
                        model_id: modelId,
                        year: selectedYear,
                        division_id: selectedDivisionId
                    },
                    success: function(response) {
                        let styleSelect = $('#style');
                        styleSelect.empty(); // Clear existing options

                        if (response.styles.length > 0) {
                            $.each(response.styles, function(key, style) {
                                styleSelect.append('<option value="' + style.id + '">' +
                                    style.name + '</option>');
                            });
                            // Alert the user or display the count message
                            $('#style-count').text('Styles available: ' + response.styles
                                .length);
                        } else {
                            styleSelect.append(
                                '<option value="">No Styles Available</option>');
                            $('#style-count').text('No styles available.');
                            $('#update-styles').show();
                        }
                    }
                });
            });

            $('#style').change(function() {
                let styleIds = $(this).val(); // Get the selected style IDs (multi-select)
                let selectedYear = $('#year option:selected')
            .val(); // Get the selected style IDs (multi-select)
                let selectedModelId = $('#model option:selected').val(); // Get the selected model's name
                let selectedDivisionId = $('#model option:selected').val(); // Get the selected model's name
                let selectedModelName = $('#model option:selected').text(); // Get the selected model's name
                if (styleIds && styleIds.length > 0) {
                    $('.preloader').css('display', 'block');
                    $.ajax({
                        url: baseURL +
                            '/admin/api/vehicles', // API route to fetch vehicles based on styles
                        method: 'GET',
                        data: {
                            year: selectedYear,
                            division_id: selectedDivisionId,
                            model_id: selectedModelId,
                            style_ids: styleIds
                        },
                        success: function(response) {
                            let vehicleSelect = $(
                                '#vehicle'); // Assuming there's a vehicle dropdown
                            vehicleSelect.empty(); // Clear existing options

                            // Check if the response contains a vehicle count when "all" is selected
                            if (response.vehicles && response.vehicles.length > 0) {
                                $.each(response.vehicles, function(key, vehicle) {
                                    vehicleSelect.append('<option value="' + vehicle
                                        .id + '">' + vehicle.name + '</option>');
                                });
                                // Display the count of available vehicles
                                $('#vehicle-count').text('Vehicles available: ' + response
                                    .vehicles.length);
                            } else if (response.vehicles && response.vehicles.id) {
                                // If response contains the count when "all" is selected
                                vehicleSelect.append('<option value="all">' + response.vehicles
                                    .name + '</option>');
                                $('#vehicle-count').text(response.vehicles.name);
                            } else {
                                vehicleSelect.append(
                                    '<option value="all">No Vehicles Available</option>');
                                $('#vehicle-count').text('No vehicles available.');
                                $('#update-vehicle').show();
                            }
                            $('.preloader').css('display', 'none');
                        },
                        error: function() {
                            $('.preloader').css('display', 'none');
                            alert('Error fetching vehicles. Please try again.');
                        }
                    });
                } else {
                    // If no styles are selected, clear vehicle dropdown and count
                    $('#vehicle').empty();
                    $('#vehicle-count').text('');
                    alert('Please select at least one style.');
                }
            });





            $('#update-models').click(function() {
                let divisionId = $('#division').val();
                let year = $('#year option:selected').val();
                if (divisionId && year) {
                    const confirmed = confirm(
                        `This will fetch all models of the selected year (${year}) and division(s) (${divisionId}). Are you sure? The number of API calls will be equal to the number of divisions`
                    );

                    if (!confirmed) {
                        // If the user cancels, prevent the request from proceeding
                        event.preventDefault();
                        return;
                    }
                    $('.preloader').css('display', 'block');
                    $.ajax({
                        url: baseURL +
                            '/admin/api/update-models', // The route to trigger fetching/updating models
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            division_id: divisionId,
                            year: year
                        },
                        success: function(response) {
                            let modelSelect = $('#model');
                            modelSelect.empty();

                            if (response.models.length > 0) {
                                $.each(response.models, function(index, model) {
                                    modelSelect.append('<option value="' + model.id +
                                        '">' + model.name + '</option>');
                                });
                                $('#model-count').text(response.models.length +
                                    ' models updated.');
                            } else {
                                modelSelect.append(
                                    '<option value="">No models available</option>');
                                $('#model-count').text('No models found for this division.');
                            }
                            $('.preloader').css('display', 'none');
                        },
                        error: function() {
                            $('.preloader').css('display', 'none');
                            alert('Error fetching models. Please try again.');
                        }
                    });
                } else {
                    alert('Please select a division first.');
                }
            });

            $('#update-divisions').click(function() {
                let year = $('#year option:selected').val();

                if (year) {
                    const confirmed = confirm(
                        `This will fetch all divisions of the selected year (${year}). Are you sure? The API call will be 1`
                    );

                    if (!confirmed) {
                        // If the user cancels, prevent the request from proceeding
                        event.preventDefault();
                        return;
                    }
                    $('.preloader').css('display', 'block');
                    $.ajax({
                        url: baseURL +
                            '/admin/api/update-divisions', // The route to trigger fetching/updating models
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            year: year
                        },
                        success: function(response) {
                            let divisionSelect = $('#division');
                            divisionSelect.empty();
                            divisionSelect.append(
                                '<option value="all">All Divisions</option>');
                            if (response.divisions.length > 0) {
                                $.each(response.divisions, function(index, division) {
                                    divisionSelect.append('<option value="' + division
                                        .id +
                                        '">' + division.name + '</option>');
                                });
                                $('#division-count').text(response.divisions.length +
                                    ' models updated.');
                            } else {
                                divisionSelect.append(
                                    '<option value="">No divisions available</option>');
                                $('#division-count').text('No divisions found for this year.');
                            }
                            $('.preloader').css('display', 'none');
                        },
                        error: function() {
                            $('.preloader').css('display', 'none');
                            alert('Error fetching divisions. Please try again.');
                        }
                    });
                } else {
                    alert('Please select a year first.');
                }

            });

            $('#update-styles').click(function() {
                let year = $('#year option:selected').val();
                let divisionId = $('#division').val();
                let modelId = $('#model').val();
                if (modelId) {
                    const confirmed = confirm(
                        `This will fetch all styles of the selected model (${modelId}). The number of API calls will be equal to the number of models Are you sure?`
                    );

                    if (!confirmed) {
                        // If the user cancels, prevent the request from proceeding
                        event.preventDefault();
                        return;
                    }
                    $('.preloader').css('display', 'block');
                    $.ajax({
                        url: baseURL +
                            '/admin/api/update-styles',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            year: year,
                            division_id: divisionId,
                            model_id: modelId
                        },
                        success: function(response) {
                            let styleSelect = $('#style'); // Select the style dropdown
                            styleSelect.empty();

                            if (response.styles.length > 0) {
                                $.each(response.styles, function(index, style) {
                                    styleSelect.append('<option value="' + style.id +
                                        '">' + style.name + '</option>');
                                });
                                $('#style-count').text(response.styles.length +
                                    ' styles updated.');
                            } else {
                                styleSelect.append(
                                    '<option value="">No styles available</option>');
                                $('#style-count').text('No styles found for this model.');
                            }
                            $('.preloader').css('display', 'none');
                        },
                        error: function() {
                            $('.preloader').css('display', 'none');
                            alert('Error fetching styles. Please try again.');
                        }
                    });
                } else {
                    alert('Please select a model first.');
                    $('.preloader').css('display',
                        'none'); // Hide preloader when no division or year is selected
                }
            });

            $('#vehicle-update').click(function() {

                let selectedYear = $('#year option:selected').val()
                let divisionId = $('#division').val(); // Get selected division
                let modelId = $('#model').val(); // Get selected model
                let styleIds = $('#style').val(); // Get selected styles (multi-select)
                let limit = $('#limit').val(); // Get vehicles limit
                let withImages = $('#withImages').is(':checked') ? 1 :
                    0; // Check if "With Images" is checked

                if (!selectedYear) {
                    alert('Please select a year first.');
                    return;
                }
                if (!limit) {
                    const confirmed = confirm(
                        `Are you sure you want to go without limit!`
                    );

                    if (!confirmed) {
                        // If the user cancels, prevent the request from proceeding
                        event.preventDefault();
                        return;
                    }
                }

                let fetchData = {
                    year: selectedYear,
                    division_id: divisionId || null, // Optional: If division is selected
                    model_id: modelId || null, // Optional: If model is selected
                    style_ids: styleIds || [], // Optional: If styles are selected
                    vehicles_limit: limit, // Vehicles limit (optional)
                    with_images: withImages // With Images flag
                };

                const confirmed = confirm(
                    `This will fetch all vehicles of the selected style(s). The number of API calls will be equal to the number of styles Are you sure, you want to continue?`
                );

                if (!confirmed) {
                    // If the user cancels, prevent the request from proceeding
                    event.preventDefault();
                    return;
                }
                $('.preloader').css('display', 'block');

                $.ajax({
                    url: baseURL +
                        '/admin/api/update-vehicles', // The API route to fetch vehicles
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        ...fetchData
                    },
                    success: function(response) {
                        let vehicleSelect = $('#vehicle');
                        vehicleSelect.empty(); // Clear existing vehicle options

                        if (response.vehicles.length > 0) {
                            $.each(response.vehicles, function(index, vehicle) {
                                vehicleSelect.append('<option value="' + vehicle
                                    .id + '">' + vehicle.name + '</option>');
                            });
                            $('#vehicle-count').text(response.vehicles.length +
                                ' vehicles found.');
                        } else {
                            vehicleSelect.append(
                                '<option value="">No vehicles available</option>');
                            $('#vehicle-count').text(
                                'No vehicles found for the selected styles.');
                        }

                        $('.preloader').css('display',
                            'none');
                    },
                    error: function() {
                        alert('Error fetching vehicles. Please try again.');
                        $('.preloader').css('display', 'none'); // Hide preloader on error
                    }
                });

            });





        });
    </script>
    @stack('script')
</body>

</html>
