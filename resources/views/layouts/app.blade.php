<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="../../assets/js/jquery.tagify.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/themes.php.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
    <link href="{{ asset('perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('select2/select.min.css') }}" rel="stylesheet">

  </head>
<body>
    <div id="app" class="">








        @yield('content')



    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('select2/select2.min.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.tagify.js') }}"></script>
    <script src="../../assets/js/app.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>



</body>


</html>
<div class="sidebar"></div>
<script>


    (function ($) {
        // USE STRICT
        "use strict";

        // Scroll Bar
        try {
            var jscr1 = $('.js-scrollbar1');
            if(jscr1[0]) {
                const ps1 = new PerfectScrollbar('.js-scrollbar1');
            }

            var jscr2 = $('.js-scrollbar2');
            if (jscr2[0]) {
                const ps2 = new PerfectScrollbar('.js-scrollbar2');

            }

        } catch (error) {
            console.log(error);
        }

    })(jQuery);


    (function ($) {
        // USE STRICT
        "use strict";

        // Select 2
        try {

            $(".js-select2").each(function () {
                $(this).select2({
                    minimumResultsForSearch: 20,
                    dropdownParent: $(this).next('.dropDownSelect2')
                });
            });

        } catch (error) {
            console.log(error);
        }


    })(jQuery);
    (function ($) {
        // USE STRICT
        "use strict";

        // Dropdown
        try {
            var menu = $('.js-item-menu');
            var sub_menu_is_showed = -1;

            for (var i = 0; i < menu.length; i++) {
                $(menu[i]).on('click', function (e) {
                    e.preventDefault();
                    $('.js-right-sidebar').removeClass("show-sidebar");
                    if (jQuery.inArray(this, menu) == sub_menu_is_showed) {
                        $(this).toggleClass('show-dropdown');
                        sub_menu_is_showed = -1;
                    }
                    else {
                        for (var i = 0; i < menu.length; i++) {
                            $(menu[i]).removeClass("show-dropdown");
                        }
                        $(this).toggleClass('show-dropdown');
                        sub_menu_is_showed = jQuery.inArray(this, menu);
                    }
                });
            }
            $(".js-item-menu, .js-dropdown").click(function (event) {
                event.stopPropagation();
            });

            $("body,html").on("click", function () {
                for (var i = 0; i < menu.length; i++) {
                    menu[i].classList.remove("show-dropdown");
                }
                sub_menu_is_showed = -1;
            });

        } catch (error) {
            console.log(error);
        }

        var wW = $(window).width();
        // Right Sidebar
        var right_sidebar = $('.js-right-sidebar');
        var sidebar_btn = $('.js-sidebar-btn');

        sidebar_btn.on('click', function (e) {
            e.preventDefault();
            for (var i = 0; i < menu.length; i++) {
                menu[i].classList.remove("show-dropdown");
            }
            sub_menu_is_showed = -1;
            right_sidebar.toggleClass("show-sidebar");
        });

        $(".js-right-sidebar, .js-sidebar-btn").click(function (event) {
            event.stopPropagation();
        });

        $("body,html").on("click", function () {
            right_sidebar.removeClass("show-sidebar");

        });


        // Sublist Sidebar
        try {
            var arrow = $('.js-arrow');
            arrow.each(function () {
                var that = $(this);
                that.on('click', function (e) {
                    e.preventDefault();
                    that.find(".arrow").toggleClass("up");
                    that.toggleClass("open");
                    that.parent().find('.js-sub-list').slideToggle("250");
                });
            });

        } catch (error) {
            console.log(error);
        }


        try {
            // Hamburger Menu
            $('.hamburger').on('click', function () {
                $(this).toggleClass('is-active');
                $('.navbar-mobile').slideToggle('500');
            });
            $('.navbar-mobile__list li.has-dropdown > a').on('click', function () {
                var dropdown = $(this).siblings('ul.navbar-mobile__dropdown');
                $(this).toggleClass('active');
                $(dropdown).slideToggle('500');
                return false;
            });
        } catch (error) {
            console.log(error);
        }
    })(jQuery);
    (function ($) {
        // USE STRICT
        "use strict";

        // Load more
        try {
            var list_load = $('.js-list-load');
            if (list_load[0]) {
                list_load.each(function () {
                    var that = $(this);
                    that.find('.js-load-item').hide();
                    var load_btn = that.find('.js-load-btn');
                    load_btn.on('click', function (e) {
                        $(this).text("Loading...").delay(1500).queue(function (next) {
                            $(this).hide();
                            that.find(".js-load-item").fadeToggle("slow", 'swing');
                        });
                        e.preventDefault();
                    });
                })

            }
        } catch (error) {
            console.log(error);
        }

    })(jQuery);

</script>
<script >
    $('.toogle-sidebar').click(function(){
        $('.menu-sidebar2').toggleClass('show-sidebar');
    })


</script>
