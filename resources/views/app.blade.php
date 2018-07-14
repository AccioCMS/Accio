<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="{{ URL::asset('public/backend/admin-theme-modules/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::asset('public/backend/admin-theme-modules/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ URL::asset('public/backend/admin-theme-modules/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ URL::asset('public/backend/admin-theme-modules/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ URL::asset('public/backend/admin-theme-modules/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <!-- Switchery -->
    <link href="{{ URL::asset('public/backend/admin-theme-modules/switchery/dist/switchery.min.css') }}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{ URL::asset('public/backend/admin-theme-modules/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ URL::asset('public/backend/admin-theme-modules/build/css/custom.min.css') }}" rel="stylesheet">

    <!-- Base style -->
    <link href="{{ URL::asset('public/css/base-admin-style.css') }}" rel="stylesheet">

    <!-- Select2 -->
    <link href="{{ URL::asset('public/backend/admin-theme-modules/select2/dist/css/select2.min.css') }}" rel="stylesheet">

    <title>{{ settings('siteTitle') }}</title>

    <script>
        window.globalProjectDirectory = "<?php echo projectDirectory(); ?>";
        window.Laravel = { csrfToken: '{{ csrf_token() }}' };
    </script>
    <!-- CROP -->
    <link href="{{ URL::asset('public/backend/crop/jquery.selectareas.css') }}" media="screen" rel="stylesheet" type="text/css" />
    <!--[if lte IE 8]><link href="{{ URL::asset('public/backend/crop//jquery.selectareas.ie8.css') }}" media="screen" rel="stylesheet" type="text/css" /> <![endif]-->
</head>

<body class="nav-md">

<div class="container body" id="app">
    @yield('content')
</div>

<div id="loading">
    <div id="loadingContainer">
        <img src="<?php echo projectDirectory(); ?>/public/images/loading.svg" alt="">
        <span class="text">Please wait...</span>
    </div>
</div>

<!-- jQuery -->
<script src="{{ URL::asset('public/backend/admin-theme-modules/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ URL::asset('public/backend/admin-theme-modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- VUE JS SCRIPT -->
<?php
// if we are in a plugin route
$pluginData = null;
if(\Request::is('*/plugins/*/*')){
    // get plugin author and plugin name
    $link = explode("plugins/", \Request::url());
    $pluginParams = explode("/",$link[1]);

    foreach(\App\Models\Plugin::configs() as $plugin){
        if($plugin->baseURL == $link[1]){
            $pluginData = $plugin;
            break;
        }
    }
}

if($pluginData){
?>
<!-- VUE JS SCRIPT -->
<script src="{{ URL::asset('public/plugins/'.$pluginData->namespace.'/public/js/app.js?'.session()->getId()) }}"></script>
<?php
}else{ ?>
<script src="{{ URL::asset('public/js/app.js?'.session()->getId()) }}"></script>
<?php
}
?>

{{-- sortable plugin --}}
<script src="{{ URL::asset('public/backend/sortable.js') }}"></script>
<!-- The plugin that handles the drag and drop of the menu links -->
<script src="{{ URL::asset('public/backend/jquery.nestable.js') }}"></script>

<!-- FastClick -->
<script src="{{ URL::asset('public/backend/admin-theme-modules/fastclick/lib/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ URL::asset('public/backend/admin-theme-modules/nprogress/nprogress.js') }}"></script>

<!-- iCheck -->
<script src="{{ URL::asset('public/backend/admin-theme-modules/iCheck/icheck.min.js') }}"></script>

<script src="{{ URL::asset('public/backend/admin-theme-modules/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>

<!-- bootstrap-daterangepicker -->
<script src="{{ URL::asset('public/backend/admin-theme-modules/moment/min/moment.min.js') }}"></script>
<script src="{{ URL::asset('public/backend/admin-theme-modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- Switchery -->
<script src="{{ URL::asset('public/backend/admin-theme-modules/switchery/dist/switchery.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ URL::asset('public/backend/admin-theme-modules/select2/dist/js/select2.full.min.js') }}"></script>
<!-- Autosize -->
<script src="{{ URL::asset('public/backend/admin-theme-modules/autosize/dist/autosize.min.js') }}"></script>
<!-- jQuery autocomplete -->
<script src="{{ URL::asset('public/backend/admin-theme-modules/devbridge-autocomplete/dist/jquery.autocomplete.min.js') }}"></script>

<script src="https://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>

<!-- CROP -->
<script src="{{ URL::asset('public/backend/crop/jquery.selectareas.js') }}" type="text/javascript"></script>

<!-- Custom Theme Scripts -->
{{--<script src="{{ URL::asset('public/backend/admin-theme-modules/build/js/custom.min.js') }}"></script>--}}
<script src="{{ URL::asset('public/backend/base-function.js') }}"></script>

</body>
</html>