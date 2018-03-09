<!DOCTYPE html>
<html>
<head>
    @yield('head')
    <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/css/core.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/css/components.css')}} " rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/css/icons.css')}} " rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/css/pages.css')}} " rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/css/responsive.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/sweetalert.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/dropify.min.css')}}" rel="stylesheet" type="text/css"/>


    <script src="{{asset('assets/admin/js/modernizr.min.js')}}"></script>

</head>

<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
@include('admin.layouts.topbar')
<!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
@include('admin.layouts.leftsidebar')
<!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">

                        @yield('title_content')

                    </div>
                </div>

                @yield('content')

            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer">
            © 2017. All rights reserved.
        </footer>

    </div>
    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


    <!-- Right Sidebar -->
@include('admin.layouts.rightsidebar')
<!-- /Right-bar -->


</div>
<!-- END wrapper -->

<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{{asset('assets/admin/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/admin/js/detect.js')}}"></script>
<script src="{{asset('assets/admin/js/fastclick.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('assets/admin/js/waves.js')}}"></script>
<script src="{{asset('assets/admin/js/wow.min.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('assets/admin/js/sweetalert.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="{{asset('assets/admin/js/dropify.min.js') }}"></script>

@yield('js')

<script src="{{asset('assets/admin/js/jquery.core.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.app.js')}}"></script>

</body>
</html>