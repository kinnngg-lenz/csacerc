<!DOCTYPE html>
<html lang="en">
<head>
    @yield('styles')
</head>
<style>

    .navbar {
        position: relative;
        min-height: 60px;
        margin-bottom: 21px;
        border: 1px solid transparent;
    }
    @media (min-width: 768px) {
        .navbar {
            border-radius: 4px;
        }
    }
    @media (min-width: 768px) {
        .navbar-header {
            float: left;
        }
    }
    .navbar-collapse {
        overflow-x: visible;
        padding-right: 15px;
        padding-left: 15px;
        border-top: 1px solid transparent;
        -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);
        -webkit-overflow-scrolling: touch;
    }
    .navbar-collapse.in {
        overflow-y: auto;
    }
    @media (min-width: 768px) {
        .navbar-collapse {
            width: auto;
            border-top: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        .navbar-collapse.collapse {
            display: block !important;
            height: auto !important;
            padding-bottom: 0;
            overflow: visible !important;
        }
        .navbar-collapse.in {
            overflow-y: visible;
        }
        .navbar-fixed-top .navbar-collapse,
        .navbar-static-top .navbar-collapse,
        .navbar-fixed-bottom .navbar-collapse {
            padding-left: 0;
            padding-right: 0;
        }
    }
    .navbar-fixed-top .navbar-collapse,
    .navbar-fixed-bottom .navbar-collapse {
        max-height: 340px;
    }
    @media (max-device-width: 480px) and (orientation: landscape) {
        .navbar-fixed-top .navbar-collapse,
        .navbar-fixed-bottom .navbar-collapse {
            max-height: 200px;
        }
    }
    .container > .navbar-header,
    .container-fluid > .navbar-header,
    .container > .navbar-collapse,
    .container-fluid > .navbar-collapse {
        margin-right: -15px;
        margin-left: -15px;
    }
    @media (min-width: 768px) {
        .container > .navbar-header,
        .container-fluid > .navbar-header,
        .container > .navbar-collapse,
        .container-fluid > .navbar-collapse {
            margin-right: 0;
            margin-left: 0;
        }
    }
    .navbar-static-top {
        z-index: 1000;
        border-width: 0 0 1px;
    }
    @media (min-width: 768px) {
        .navbar-static-top {
            border-radius: 0;
        }
    }
    .navbar-fixed-top,
    .navbar-fixed-bottom {
        position: fixed;
        right: 0;
        left: 0;
        z-index: 1030;
    }
    @media (min-width: 768px) {
        .navbar-fixed-top,
        .navbar-fixed-bottom {
            border-radius: 0;
        }
    }
    .navbar-fixed-top {
        top: 0;
        border-width: 0 0 1px;
    }
    .navbar-fixed-bottom {
        bottom: 0;
        margin-bottom: 0;
        border-width: 1px 0 0;
    }
    .navbar-brand {
        float: left;
        padding: 19.5px 15px;
        font-size: 19px;
        line-height: 21px;
        height: 60px;
    }
    .navbar-brand:hover,
    .navbar-brand:focus {
        text-decoration: none;
    }
    .navbar-brand > img {
        display: block;
    }
    @media (min-width: 768px) {
        .navbar > .container .navbar-brand,
        .navbar > .container-fluid .navbar-brand {
            margin-left: -15px;
        }
    }
    .navbar-toggle {
        position: relative;
        float: right;
        margin-right: 15px;
        padding: 9px 10px;
        margin-top: 13px;
        margin-bottom: 13px;
        background-color: transparent;
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
    }
    .navbar-toggle:focus {
        outline: 0;
    }
    .navbar-toggle .icon-bar {
        display: block;
        width: 22px;
        height: 2px;
        border-radius: 1px;
    }
    .navbar-toggle .icon-bar + .icon-bar {
        margin-top: 4px;
    }
    @media (min-width: 768px) {
        .navbar-toggle {
            display: none;
        }
    }
    .navbar-nav {
        margin: 9.75px -15px;
    }
    .navbar-nav > li > a {
        padding-top: 10px;
        padding-bottom: 10px;
        line-height: 21px;
    }
    @media (max-width: 767px) {
        .navbar-nav .open .dropdown-menu {
            position: static;
            float: none;
            width: auto;
            margin-top: 0;
            background-color: transparent;
            border: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        .navbar-nav .open .dropdown-menu > li > a,
        .navbar-nav .open .dropdown-menu .dropdown-header {
            padding: 5px 15px 5px 25px;
        }
        .navbar-nav .open .dropdown-menu > li > a {
            line-height: 21px;
        }
        .navbar-nav .open .dropdown-menu > li > a:hover,
        .navbar-nav .open .dropdown-menu > li > a:focus {
            background-image: none;
        }
    }
    @media (min-width: 768px) {
        .navbar-nav {
            float: left;
            margin: 0;
        }
        .navbar-nav > li {
            float: left;
        }
        .navbar-nav > li > a {
            padding-top: 19.5px;
            padding-bottom: 19.5px;
        }
    }
    .navbar-form {
        margin-left: -15px;
        margin-right: -15px;
        padding: 10px 15px;
        border-top: 1px solid transparent;
        border-bottom: 1px solid transparent;
        -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 0 rgba(255, 255, 255, 0.1);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 0 rgba(255, 255, 255, 0.1);
        margin-top: 8.5px;
        margin-bottom: 8.5px;
    }
    @media (min-width: 768px) {
        .navbar-form .form-group {
            display: inline-block;
            margin-bottom: 0;
            vertical-align: middle;
        }
        .navbar-form .form-control {
            display: inline-block;
            width: auto;
            vertical-align: middle;
        }
        .navbar-form .form-control-static {
            display: inline-block;
        }
        .navbar-form .input-group {
            display: inline-table;
            vertical-align: middle;
        }
        .navbar-form .input-group .input-group-addon,
        .navbar-form .input-group .input-group-btn,
        .navbar-form .input-group .form-control {
            width: auto;
        }
        .navbar-form .input-group > .form-control {
            width: 100%;
        }
        .navbar-form .control-label {
            margin-bottom: 0;
            vertical-align: middle;
        }
        .navbar-form .radio,
        .navbar-form .checkbox {
            display: inline-block;
            margin-top: 0;
            margin-bottom: 0;
            vertical-align: middle;
        }
        .navbar-form .radio label,
        .navbar-form .checkbox label {
            padding-left: 0;
        }
        .navbar-form .radio input[type="radio"],
        .navbar-form .checkbox input[type="checkbox"] {
            position: relative;
            margin-left: 0;
        }
        .navbar-form .has-feedback .form-control-feedback {
            top: 0;
        }
    }
    @media (max-width: 767px) {
        .navbar-form .form-group {
            margin-bottom: 5px;
        }
        .navbar-form .form-group:last-child {
            margin-bottom: 0;
        }
    }
    @media (min-width: 768px) {
        .navbar-form {
            width: auto;
            border: 0;
            margin-left: 0;
            margin-right: 0;
            padding-top: 0;
            padding-bottom: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
    }
    .navbar-nav > li > .dropdown-menu {
        margin-top: 0;
        border-top-right-radius: 0;
        border-top-left-radius: 0;
    }
    .navbar-fixed-bottom .navbar-nav > li > .dropdown-menu {
        margin-bottom: 0;
        border-top-right-radius: 4px;
        border-top-left-radius: 4px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .navbar-btn {
        margin-top: 8.5px;
        margin-bottom: 8.5px;
    }
    .navbar-btn.btn-sm {
        margin-top: 13.5px;
        margin-bottom: 13.5px;
    }
    .navbar-btn.btn-xs {
        margin-top: 19px;
        margin-bottom: 19px;
    }
    .navbar-text {
        margin-top: 19.5px;
        margin-bottom: 19.5px;
    }
    @media (min-width: 768px) {
        .navbar-text {
            float: left;
            margin-left: 15px;
            margin-right: 15px;
        }
    }
    @media (min-width: 768px) {
        .navbar-left {
            float: left !important;
        }
        .navbar-right {
            float: right !important;
            margin-right: -15px;
        }
        .navbar-right ~ .navbar-right {
            margin-right: 0;
        }
    }
    .navbar-inverse {
        background: url('/images/static/head.png') #2E2E2E;
        border-color: transparent;
        box-shadow: #505050 2px -1px 11px;
        -webkit-box-shadow: #505050 2px -1px 11px;
        -moz-box-shadow: #505050 2px -1px 11px;
        -o-box-shadow: #505050 2px -1px 11px;
    }
    .navbar-inverse .navbar-brand {
        color: #ffffff;
    }
    .navbar-inverse .navbar-brand:hover,
    .navbar-inverse .navbar-brand:focus {
        color: #000000;
        background-color: transparent;
    }
    .navbar-inverse .navbar-text {
        color: #ffffff;
    }
    .navbar-inverse .navbar-nav > li > a {
        color: #ffffff;
    }
    .navbar-inverse .navbar-nav > li > a:hover,
    .navbar-inverse .navbar-nav > li > a:focus {
        color: #2E2E2E;
        background-color: #F9F6F6;
    }
    .navbar-inverse .navbar-nav > .active > a,
    .navbar-inverse .navbar-nav > .active > a:hover,
    .navbar-inverse .navbar-nav > .active > a:focus {
        color: #ffffff;
        background-color: #2E2E2E;
    }
    .navbar-inverse .navbar-nav > .disabled > a,
    .navbar-inverse .navbar-nav > .disabled > a:hover,
    .navbar-inverse .navbar-nav > .disabled > a:focus {
        color: #cccccc;
        background-color: transparent;
    }
    .navbar-inverse .navbar-toggle {
        border-color: #2E2E2E;
    }
    .navbar-inverse .navbar-toggle:hover,
    .navbar-inverse .navbar-toggle:focus {
        background-color: #2E2E2E;
    }
    .navbar-inverse .navbar-toggle .icon-bar {
        background-color: #ffffff;
    }
    .navbar-inverse .navbar-collapse,
    .navbar-inverse .navbar-form {
        border-color: #2E2E2E;
    }
    .navbar-inverse .navbar-nav > .open > a,
    .navbar-inverse .navbar-nav > .open > a:hover,
    .navbar-inverse .navbar-nav > .open > a:focus {
        background-color: #2E2E2E;
        color: #ffffff;
    }
    @media (max-width: 767px) {
        .navbar-inverse .navbar-nav .open .dropdown-menu > .dropdown-header {
            border-color: transparent;
        }
        .navbar-inverse .navbar-nav .open .dropdown-menu .divider {
            background-color: transparent;
        }
        .navbar-inverse .navbar-nav .open .dropdown-menu > li > a {
            color: #ffffff;
        }
        .navbar-inverse .navbar-nav .open .dropdown-menu > li > a:hover,
        .navbar-inverse .navbar-nav .open .dropdown-menu > li > a:focus {
            color: #2E2E2E;
            background-color: transparent;
        }
        .navbar-inverse .navbar-nav .open .dropdown-menu > .active > a,
        .navbar-inverse .navbar-nav .open .dropdown-menu > .active > a:hover,
        .navbar-inverse .navbar-nav .open .dropdown-menu > .active > a:focus {
            color: #ffffff;
            background-color: #2E2E2E;
        }
        .navbar-inverse .navbar-nav .open .dropdown-menu > .disabled > a,
        .navbar-inverse .navbar-nav .open .dropdown-menu > .disabled > a:hover,
        .navbar-inverse .navbar-nav .open .dropdown-menu > .disabled > a:focus {
            color: #cccccc;
            background-color: transparent;
        }
    }
    .navbar-inverse .navbar-link {
        color: #ffffff;
    }
    .navbar-inverse .navbar-link:hover {
        color: #2E2E2E;
    }
    .navbar-inverse .btn-link {
        color: #2E2E2E;
    }
    .navbar-inverse .btn-link:hover,
    .navbar-inverse .btn-link:focus {
        color: #2E2E2E;
    }
    .navbar-inverse .btn-link[disabled]:hover,
    fieldset[disabled] .navbar-inverse .btn-link:hover,
    .navbar-inverse .btn-link[disabled]:focus,
    fieldset[disabled] .navbar-inverse .btn-link:focus {
        color: #cccccc;
    }
</style>
<body id="app-layout">
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Branding Image -->
            <a title="Voyage - Dept. of CS, ACERC" class="navbar-brand" href="{{ url('/') }}" style="padding: 6.5px 15px">
                <img src="{{ asset('/images/static/logo.png') }}" alt="ACERC" class="img" style="height: 50px;">
            </a>

            <a class="navbar-brand" href="{{ url('/') }}">
                Voyage - ACERC
            </a>
        </div>

    </div>
</nav>

    @yield('content')
            <!-- JavaScripts -->
    {{--<script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/app.js"></script>--}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}

</body>
</html>
