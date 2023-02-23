<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Futami Operator</title>
    <link href="{{asset('assets/img/logo-futami.jpg')}}" rel="icon" style="width: 50%; height:50%;">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/template/stisla/assets/modules/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/template/stisla/assets/modules/fontawesome/css/all.min.css')}}">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('assets/template/stisla/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/template/stisla/assets/css/components.css')}}">
    <!-- Start GA -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');

    </script>
    <!-- /END GA -->

    {{-- link untuk create multi form --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js" integrity="sha512-nO7wgHUoWPYGCNriyGzcFwPSF+bPDOR+NvtOYy2wMcWkrnCNPKBcFEkU80XIN14UVja0Gdnff9EmydyLlOL7mQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- Sweet alert  --}}
    <script src="{{ asset('vendor/realrashid/sweet-alert/resources/js/sweetalert.all.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
    
</head>
<body>



    @yield('content')
    @include('sweetalert::alert')



    <!-- General JS Scripts -->
    <script src="{{asset('assets/template/stisla/assets/modules/jquery.min.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/modules/popper.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/modules/tooltip.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/modules/moment.min.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/js/stisla.js')}}"></script>

    <!-- JS Libraies sweetalert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{asset('assets/template/stisla/assets/js/scripts.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/js/custom.js')}}"></script>
</body>

</html>
