<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    {{Html::style('css/bootstrap.min.css')}}
            <!-- Font Awesome -->
    {{Html::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css')}}
            <!-- Ionicons -->
    {{Html::style('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css')}}
            <!-- Theme style -->
    {{Html::style('css/AdminLTE.min.css')}}
            <!-- iCheck -->
    {{Html::style('plugins/iCheck/square/blue.css')}}

    {{Html::style('plugins/pnotify/pnotify.css')}}
    {{Html::style('plugins/pnotify/pnotify.brighttheme.css')}}
    {{Html::style('plugins/pnotify/pnotify.buttons.css')}}


    @stack('css')
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        /* Not PNotify specific, just make this page a little more presentable. */
        #switcher-container {
            position: fixed;
            top: 60px;
            right: 5px;
            z-index: 100;
        }
        #switcher-jqueryui, #switcher-jqueryui * {
            box-sizing: content-box;
        }
        @media (max-width: 980px) {
            #switcher-container {
                position: absolute;
                top: 55px;
            }
        }
        .ui-widget {
            font-size: 75% !important;
        }
        .btn-toolbar {
            line-height: 28px;
        }
        .btn-toolbar h4 {
            margin: 1em 0 .3em;
        }
        .btn-toolbar .btn-group {
            vertical-align: middle;
        }
        .panel .btn {
            margin-top: 5px;
        }

        /* Translucent notice CSS */
        .ui-pnotify.translucent.ui-pnotify-fade-in {
            opacity: .8;
        }

        /* Custom styled notice CSS */
        .ui-pnotify.custom .ui-pnotify-container {
            background-color: #404040 !important;
            background-image: none !important;
            border: none !important;
            -moz-border-radius: 10px;
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }
        .ui-pnotify.custom .ui-pnotify-title, .ui-pnotify.custom .ui-pnotify-text {
            font-family: Arial, Helvetica, sans-serif !important;
            text-shadow: 2px 2px 3px black !important;
            font-size: 10pt !important;
            color: #FFF !important;
            padding-left: 50px !important;
            line-height: 1 !important;
            text-rendering: geometricPrecision !important;
        }
        .ui-pnotify.custom .ui-pnotify-title {
            font-weight: bold;
        }
        .ui-pnotify.custom .ui-pnotify-icon {
            float: left;
        }
        .ui-pnotify.custom .fa {
            margin: 3px;
            width: 33px;
            height: 33px;
            font-size: 33px;
            color: #FF0;
        }

        /* Alternate stack initial positioning. This one is done through code,
            to show how it is done. Look down at the stack_bottomright variable
            in the JavaScript below. */
        .ui-pnotify.stack-bottomright {
            /* These are just CSS default values to reset the PNotify CSS. */
            right: auto;
            top: auto;
            left: auto;
            bottom: auto;
        }
        .ui-pnotify.stack-custom {
            /* Custom values have to be in pixels, because the code parses them. */
            top: 200px;
            left: 200px;
            right: auto;
        }
        .ui-pnotify.stack-custom2 {
            top: auto;
            left: auto;
            bottom: 200px;
            right: 200px;
        }
        /* This one is totally different. It stacks at the top and looks
            like a Microsoft-esque browser notice bar. */
        .ui-pnotify.stack-bar-top {
            right: 0;
            top: 0;
        }
        .ui-pnotify.stack-bar-bottom {
            margin-left: 0;
            right: auto;
            bottom: 0;
            top: auto;
            left: auto;
        }
    </style>
</head>
<body class="hold-transition">
@yield('content')
        <!-- /.login-box -->

<!-- jQuery 2.2.3 -->
{{Html::script('plugins/jQuery/jquery-2.2.3.min.js')}}
        <!-- Bootstrap 3.3.6 -->
{{Html::script('js/bootstrap.min.js')}}
        <!-- iCheck -->
{{Html::script('plugins/iCheck/icheck.min.js')}}

{{Html::script('plugins/pnotify/pnotify.js')}}
{{Html::script('plugins/pnotify/pnotify.animate.js')}}
{{Html::script('plugins/pnotify/pnotify.nonblock.js')}}

@stack('js')
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
