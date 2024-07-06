<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>
        @yield('title')
    </title>
    <meta name="description" content="Add user example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Fonts -->
    <!--end::Page Custom Styles -->

    <!--begin:: Global Mandatory Vendors -->
    <link href="{{ asset('admin-assets/css') }}/perfect-scrollbar.css" rel="stylesheet" type="text/css" />

    <!--end:: Global Mandatory Vendors -->
    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ asset('admin-assets/css') }}/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css') }}/lineawesome.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{ asset('admin-assets/css') }}/base-light.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css') }}/menu-light.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css') }}/brand-dark.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css') }}/aside-dark.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css') }}/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css') }}/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css') }}/select2.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css') }}/style.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css') }}/summernote.css" rel="stylesheet" type="text/css" />

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{ asset('admin-assets/icons') }}/favicon.ico" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->

<!-- begin:: Header Mobile -->
@include('admin.includes.header-mobile')
<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        <!-- begin:: Aside -->
    @include('admin.includes.sidebar')
    <!-- end:: Aside -->
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            <!-- begin:: Header -->
        @include('admin.includes.header')
        <!-- end:: Header -->
            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                <!-- begin:: Content -->
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                    @yield('content')
                </div>

                <!-- end:: Content -->
            </div>

            <!-- begin:: Footer -->
            <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                <div class="kt-container  kt-container--fluid ">
                    <div class="kt-footer__copyright">
                        2019&nbsp;&copy;&nbsp;<a href="http://keenthemes.com/metronic" target="_blank" class="kt-link">Keenthemes</a>
                    </div>
                    <div class="kt-footer__menu">
                        <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">About</a>
                        <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
                        <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
                    </div>
                </div>
            </div>

            <!-- end:: Footer -->
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>

<!-- end::Scrolltop -->



<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin:: Global Mandatory Vendors -->
<script src="{{ asset('admin-assets/js') }}/jquery.js" type="text/javascript"></script>
<script src="{{ asset('admin-assets/js') }}/popper.js" type="text/javascript"></script>
<script src="{{ asset('admin-assets/js') }}/bootstrap.min.js" type="text/javascript"></script>
<script src="{{ asset('admin-assets/js') }}/js.cookie.js" type="text/javascript"></script>
<script src="{{ asset('admin-assets/js') }}/moment.min.js" type="text/javascript"></script>
<script src="{{ asset('admin-assets/js') }}/tooltip.min.js" type="text/javascript"></script>
<script src="{{ asset('admin-assets/js') }}/perfect-scrollbar.js" type="text/javascript"></script>
<script src="{{ asset('admin-assets/js') }}/sticky.min.js" type="text/javascript"></script>
<script src="{{ asset('admin-assets/js') }}/wNumb.js" type="text/javascript"></script>

<!--end:: Global Mandatory Vendors -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('admin-assets/js') }}/scripts.bundle.js" type="text/javascript"></script>
<script src="{{ asset('admin-assets/js') }}/datatables.bundle.js" type="text/javascript"></script>
<script src="{{ asset('admin-assets/js') }}/sweetalert.min.js" type="text/javascript"></script>
<script src="{{ asset('admin-assets/js') }}/select2.full.js" type="text/javascript"></script>
<script src="{{ asset('admin-assets/js') }}/summernote.js" type="text/javascript"></script>

@stack('script')
<!--end::Global Theme Bundle -->
</body>

<!-- end::Body -->
</html>
