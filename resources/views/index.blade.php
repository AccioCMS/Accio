<!doctype html>
<html lang="en">

<head>

    <title>Accio</title>
    <base href="/">

    <meta charset="utf-8">
    <meta name="description" content="Material design admin template with pre-built apps and pages">
    <meta name="keywords"
          content="HTML,CSS,AngularJS,Angular,Angular 2,Angular 4,Angular 5,Angular 6,Angular 7,Material,Material 2">
    <meta name="author" content="Withinpixels">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="assets/icons/meteocons/style.css" rel="stylesheet">
    <link href="assets/icons/material-icons/outline/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/icons/font-awesome/font-awesome.min.css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,600,700" rel="stylesheet">

    <!-- FUSE Splash Screen CSS -->
    <style type="text/css">
        #fuse-splash-screen {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #2D323D;
            z-index: 99999;
            pointer-events: none;
        }

        #fuse-splash-screen .center {
            display: block;
            width: 100%;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        #fuse-splash-screen .logo {
            width: 128px;
            margin: 0 auto;
        }

        #fuse-splash-screen .logo img {
            filter: drop-shadow(0px 10px 6px rgba(0, 0, 0, 0.2))
        }
        app-root{
            width: 100%;
        }

        @keyframes spinner {
            to {transform: rotate(360deg);}
        }

        div.spinner-root:before {
            content: '';
            box-sizing: border-box;
            position: absolute;
            top: 123%;
            left: 49%;
            width: 50px;
            height: 50px;
            margin-top: -10px;
            margin-left: -10px;
            border-radius: 50%;
            border: 4px solid #039be5;
            border-top-color: transparent;
            animation: spinner .6s linear infinite;
        }
    </style>
    <!-- / FUSE Splash Screen CSS -->
</head>

<body class="theme-default">
<!-- FUSE Splash Screen -->
<fuse-splash-screen id="fuse-splash-screen">

    <div class="center">

        <div class="logo">
            <img width="128" src="assets/images/logos/fuse.svg">
        </div>
        <div class="spinner-root"></div>

    </div>

</fuse-splash-screen>
<!-- / FUSE Splash Screen -->
<app-root></app-root>
<script type="text/javascript" src="{{ url("dist/runtime.js") }}"></script>
<script type="text/javascript" src="{{ url("dist/polyfills.js") }}"></script>
<script type="text/javascript" src="{{ url("dist/styles.js") }}"></script>
<script type="text/javascript" src="{{ url("dist/scripts.js") }}"></script>
<script type="text/javascript" src="{{ url("dist/vendor.js") }}"></script>
<script type="text/javascript" src="{{ url("dist/main.js") }}"></script>
</body>

</html>
