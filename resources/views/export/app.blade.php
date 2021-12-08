<!DOCTYPE html>
<html lang="lang=" {{ str_replace('_', '-', app()->getLocale()) }}"">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ isset($title)? $title . ' | ': '' }}{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('paper/img/favicon.png') }}">
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <!-- This makes the current user's id available in javascript -->
    @if(!auth()->guest())
        <script>
            window.Laravel.userId = <?php echo auth()->user()->id; ?>
        </script>
    @endif
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset("paper/css/plugins/font-awesome-5.min.css")}}" rel="stylesheet">
    <!-- Iconfont -->
    <link href="{{ asset('paper/css/plugins/icofont.css') }}" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset('paper/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('paper/css/paper-dashboard.css') }}" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset('paper/css/plugins/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style type="text/css">
        /* Chart.js */
        @-webkit-keyframes chartjs-render-animation {
            from {
                opacity: 0.99
            }

            to {
                opacity: 1
            }
        }

        @keyframes chartjs-render-animation {
            from {
                opacity: 0.99
            }

            to {
                opacity: 1
            }
        }

        .chartjs-render-monitor {
            -webkit-animation: chartjs-render-animation 0.001s;
            animation: chartjs-render-animation 0.001s;
        }
        @php
            $color = "#009999";
            if(Auth::check() && Auth::user()->role_id == 1 || Auth::check() && Auth::user()->role_id == 2) $color = "#343a40";
            else if(Auth::check() && Auth::user()->role_id == 3 || Auth::check() && Auth::user()->role_id == 4 || Auth::check() && Auth::user()->role_id == 6 || Auth::check() && Auth::user()->role_id == 7 || Auth::check() && Auth::user()->role_id == 8 || Auth::check() && Auth::user()->role_id == 9 || Auth::check() && Auth::user()->role_id == 10) $color = "#007bff";
        @endphp
        .sidebar[data-color="primary"]:after,
        .off-canvas-sidebar[data-color="primary"]:after {
            background: {{ $color }} !important;
        }
    </style>

    @yield('css')

</head>

<body class="{{ $class }}">
    @include('back.partials.spinner')
    @auth
        <div class="wrapper">
            @include('back.partials.auth.sidebar')
            <div class="main-panel">
                @include('back.partials.auth.navbar')
                @yield('content')
                @include('back.partials.auth.footer')
            </div>
        </div>
    @else
        @include('back.partials.guest.navigation')
        <div class="wrapper wrapper-full-page ">
            <div class="full-page section-image" filter-color="black" data-image="{{ asset('paper') . '/' . ($backgroundImagePath ?? "img/bg/fabio-mangione.jpg") }}">
                @yield('content')
                @include('back.partials.guest.footer')
            </div>
        </div>
    @endauth

    <!--  Core JS Files   -->
    <script src="{{ asset('paper/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('paper/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('paper/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('paper/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('paper/js/plugins/moment.min.js') }}"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="{{ asset('paper/js/plugins/bootstrap-datetimepicker.js') }}"></script>
    <!--  Bootstrap Switch -->
    <script src="{{ asset('paper/js/plugins/bootstrap-switch.js') }}"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="{{ asset('paper/js/plugins/sweetalert.min.js') }}"></script>
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('paper/js/plugins/jquery.validate.min.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ asset('paper/js/plugins/chartjs.min.js') }}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('paper/js/plugins/bootstrap-notify.js') }}"></script>
    <!-- Control Center for Paper Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('paper/js/paper-dashboard.min.js') }}"></script>
    {{-- Demo for graph --}}
    <script src="{{ asset('paper/js/demo.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('paper/js/plugins/select2.full.min.js') }}"></script>
    <!-- autoNumeric -->
    <script src="{{ asset('paper/js/plugins/autoNumeric.js') }}"></script>
    <script src="{{ asset('paper/js/custom.js') }}"></script>
    <script src="{{ asset('paper/js/plugins/crypto-js.min.js') }}"></script>
    @yield('plugins')
    <script>
        var _iv = {!! json_encode(base64_encode(env("FIXED_ENCRYPTION_IV"))) !!}
        var _app = {!! json_encode(base64_encode(env("APP_KEY"))) !!}
        var CryptoJSAesJson = {
            stringify: function (cipherParams) {
                var j = {ct: cipherParams.ciphertext.toString(CryptoJS.enc.Base64)};
                if (cipherParams.iv) j.iv = cipherParams.iv.toString();
                if (cipherParams.salt) j.s = cipherParams.salt.toString();
                return JSON.stringify(j);
            },
            parse: function (jsonStr) {
                var j = JSON.parse(jsonStr);
                var cipherParams = CryptoJS.lib.CipherParams.create({ciphertext: CryptoJS.enc.Base64.parse(j.ct)});
                if (j.iv) cipherParams.iv = CryptoJS.enc.Hex.parse(j.iv)
                if (j.s) cipherParams.salt = CryptoJS.enc.Hex.parse(j.s)
                return cipherParams;
            }
        }
        function CryptoJSAesDecrypt(passphrase,encrypted_json_string){
            var obj_json = JSON.parse(encrypted_json_string);
            var encrypted = obj_json.ct;
            var salt = CryptoJS.enc.Hex.parse(obj_json.s);
            var iv = CryptoJS.enc.Hex.parse(obj_json.iv);
            var key = CryptoJS.PBKDF2(passphrase, salt, { hasher: CryptoJS.algo.SHA512, keySize: 64/8, iterations: 999});
            var decrypted = CryptoJS.AES.decrypt(encrypted, key, { iv: iv});
            return decrypted.toString(CryptoJS.enc.Utf8);
        }
        $(document).ready(function() {
            $('.spinner-wrapper').fadeOut('slow', function() {
                $(this).remove();
            });

            $sidebar = $('.sidebar');
            $sidebar_img_container = $sidebar.find('.sidebar-background');
            $full_page = $('.full-page');
            $sidebar_responsive = $('body > .navbar-collapse');
            sidebar_mini_active = true;
            window_width = $(window).width();
            fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();
            // if( window_width > 767 && fixed_plugin_open == 'Dashboard' ){
            //     if($('.fixed-plugin .dropdown').hasClass('show-dropdown')){
            //         $('.fixed-plugin .dropdown').addClass('show');
            //     }
            //
            // }
            $('.fixed-plugin a').click(function(event) {
                // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                if ($(this).hasClass('switch-trigger')) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    }
                }
            });
            $('.fixed-plugin .active-color span').click(function() {
                $full_page_background = $('.full-page-background');
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
                var new_color = $(this).data('color');
                if ($sidebar.length != 0) {
                    $sidebar.attr('data-active-color', new_color);
                }
                if ($full_page.length != 0) {
                    $full_page.attr('data-active-color', new_color);
                }
                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.attr('data-active-color', new_color);
                }
            });
            $('.fixed-plugin .background-color span').click(function() {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
                var new_color = $(this).data('color');
                if ($sidebar.length != 0) {
                    $sidebar.attr('data-color', new_color);
                }
                if ($full_page.length != 0) {
                    $full_page.attr('filter-color', new_color);
                }
                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.attr('data-color', new_color);
                }
            });
            $('.fixed-plugin .img-holder').click(function() {
                $full_page_background = $('.full-page-background');
                $(this).parent('li').siblings().removeClass('active');
                $(this).parent('li').addClass('active');
                var new_image = $(this).find("img").attr('src');
                if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked')
                    .length != 0) {
                    $sidebar_img_container.fadeOut('fast', function() {
                        $sidebar_img_container.css('background-image', 'url("' + new_image +
                            '")');
                        $sidebar_img_container.fadeIn('fast');
                    });
                }
                if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked')
                    .length != 0) {
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data(
                        'src');
                    $full_page_background.fadeOut('fast', function() {
                        $full_page_background.css('background-image', 'url("' +
                            new_image_full_page + '")');
                        $full_page_background.fadeIn('fast');
                    });
                }
                if ($('.switch-sidebar-image input:checked').length == 0) {
                    var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data(
                        'src');
                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                }
                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                }
            });
            $('.switch-sidebar-image input').on("switchChange.bootstrapSwitch", function() {
                $full_page_background = $('.full-page-background');
                $input = $(this);
                if ($input.is(':checked')) {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar_img_container.fadeIn('fast');
                        $sidebar.attr('data-image', '#');
                    }
                    if ($full_page_background.length != 0) {
                        $full_page_background.fadeIn('fast');
                        $full_page.attr('data-image', '#');
                    }
                    background_image = true;
                } else {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar.removeAttr('data-image');
                        $sidebar_img_container.fadeOut('fast');
                    }
                    if ($full_page_background.length != 0) {
                        $full_page.removeAttr('data-image', '#');
                        $full_page_background.fadeOut('fast');
                    }
                    background_image = false;
                }
            });
            $('.switch-mini input').on("switchChange.bootstrapSwitch", function() {
                $body = $('body');
                $input = $(this);
                if (paperDashboard.misc.sidebar_mini_active == true) {
                    $('body').removeClass('sidebar-mini');
                    paperDashboard.misc.sidebar_mini_active = false;
                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();
                } else {
                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');
                    setTimeout(function() {
                        $('body').addClass('sidebar-mini');
                        paperDashboard.misc.sidebar_mini_active = true;
                    }, 300);
                }
                // we simulate the window Resize so the charts will get updated in realtime.
                var simulateWindowResize = setInterval(function() {
                    window.dispatchEvent(new Event('resize'));
                }, 180);
                // we stop the simulation of Window Resize after the animations are completed
                setTimeout(function() {
                    clearInterval(simulateWindowResize);
                }, 1000);
            });

            $('.nominal').autoNumeric('init');
            $(".select2").select2();
            $(".select2_tag").select2({tags: true});
            $(".custom-switch-input").bootstrapSwitch();
            $('.datepicker').datetimepicker({
                format: 'MM/DD/YYYY',
                icons: { time: "fa fa-clock-o", date: "fa fa-calendar", up: "fa fa-chevron-up", down: "fa fa-chevron-down", previous: 'fa fa-chevron-left', next: 'fa fa-chevron-right', today: 'fa fa-screenshot', clear: 'fa fa-trash', close: 'fa fa-remove' }
            });
        });

        function clearCharacter(obj) {
            let hasil = obj.value.replace(/[^\w\-\" "\s]/gi, '');
            obj.value = hasil;
        }
    </script>

    @yield('js')
</body>

</html>
