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
    {{Html::style('css/skins/skin-blue.min.css')}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{Html::style('plugins/pnotify/pnotify.css')}}
    {{Html::style('plugins/pnotify/pnotify.brighttheme.css')}}
    {{Html::style('plugins/pnotify/pnotify.buttons.css')}}
    {{Html::style('plugins/pnotify/pnotify.history.css')}}

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
            margin-left: 200;
            right: auto;
            bottom: 0;
            top: auto;
            left: auto;
        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">{{config('app.app')}}</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">{{config('app.name')}}</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- Notifications Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                                <!-- Inner Menu: contains the notifications -->
                                <ul class="menu">
                                    <li><!-- start notification -->
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>
                                    <!-- end notification -->
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{asset('img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->nama }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{asset('img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                                <p>
                                    {{ Auth::user()->nama }}
                                    <small>{{Auth::user()->status->status}}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="{{url('/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->nama }}</p>
                    <!-- Status -->
                    <strong>{{Auth::user()->status->status}}</strong>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">Menu</li>
                <!-- Optionally, you can add icons to the links -->
                @inject('menu', 'App\Helpers\Navigation\Contract\NavigationContract')
                @foreach($menu->getMenu() as $keyMenu => $valueMenu)
                    @if(empty($valueMenu['submenus']))
                        <li><a href="{{route($valueMenu['url'])}}"><i class="fa {{$valueMenu['icon']}}"></i> <span>{{$valueMenu['title']}}</span></a></li>
                    @else
                        <li class="treeview">
                            <a href="#">
                                <i class="fa {{$valueMenu['icon']}}"></i> <span>{{$valueMenu['title']}}</span>
								<span class="pull-right-container">
								  <i class="fa fa-angle-left pull-right"></i>
								</span>
                            </a>
                            <ul class="treeview-menu">
                                @foreach($valueMenu['submenus'] as $keySubmenu => $valSubmenu)
                                    <li><a href="{{route($valSubmenu['url'])}}"><i class="fa {{$valSubmenu['icon']}}"></i> {{$valSubmenu['title']}}</a></li>

                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @yield('content-header')
        </section>

        <!-- Main content -->
        @yield('content')
                <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Version - {{config('app.version')}}
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 - {{config('app.name', 'Minimart')}}.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark" tabindex="-1">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane active" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                <span class="pull-right-container">
                  <span class="label label-danger pull-right">70%</span>
                </span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
{{Html::script('plugins/jQuery/jquery-2.2.3.min.js')}}
        <!-- Bootstrap 3.3.6 -->
{{Html::script('js/bootstrap.min.js')}}
        <!-- AdminLTE App -->
{{Html::script('js/app.min.js')}}

{{Html::script('plugins/pnotify/pnotify.js')}}
{{Html::script('plugins/pnotify/pnotify.animate.js')}}
{{Html::script('plugins/pnotify/pnotify.buttons.js')}}
{{Html::script('plugins/pnotify/pnotify.callbacks.js')}}
{{Html::script('plugins/pnotify/pnotify.confirm.js')}}
{{Html::script('plugins/pnotify/pnotify.desktop.js')}}
{{Html::script('plugins/pnotify/pnotify.history.js')}}
{{Html::script('plugins/pnotify/pnotify.nonblock.js')}}
{{Html::script('js/rfid.js')}}

<script>

    var csrf =  $('meta[name="csrf-token"]').attr('content');
    var modal = '' +
            '<div id="modal" class="modal modal" role="dialog" tabindex="-1" aria-labelledby="" aria-hidden="true">'+
            '<div class="modal-dialog">'+
            '<div class="modal-content">'+
            '<div class="modal-header">'+
            '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
            '<h4 class="modal-title"></h4>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>';

    var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25};
    var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
    var stack_bar_bottom = {"dir1": "up", "dir2": "right", "spacing1": 0, "spacing2": 0};
    $(function(){
        PNotify.prototype.options.styling = "bootstrap3";

        var url = window.location;
        $('ul.sidebar-menu a').filter(function() {
            return this.href == url; //true
        }).parent('li').addClass('active');
        $('ul.treeview-menu a').filter(function(){
            return this.href == url;
        }).parents('li.treeview').addClass('active');

    });

    function show_notif(notif) {
        var opts = {
            type: notif.type,
            title: notif.title,
            text: notif.text,
            addclass: "stack-bar-bottom",
            cornerclass: "",
            width: "100%",
            stack: stack_bar_bottom,
            delay: 3000
        };
        new PNotify(opts);
    }


    $(document).ajaxStart(onStart)
            .ajaxStop(onStop)
            .ajaxSend(onSend)
            .ajaxComplete(onComplete)
            .ajaxSuccess(onSuccess)
            .ajaxError(onError);

    function onStart(event) {
        console.log("START");
    }
    function onStop(event) {
        console.log("STOP");
    }
    function onSend(event, xhr, settings) {
        $(".help-block" ).remove();
        $(".form-group").removeClass('has-error');
        if(typeof settings.context !== 'undefined'){
          switch (settings.context.context) {
            case "form" :
              $('.loading').show();
            break;
            case "rfid" :
              $('body').append(modal);
              if($('form#rfid').length == 0) {
                $('.modal-content').append(rfidform);
              }
              $('.modal-title').text(settings.context.title);
              $('#modal').modal({keyboard: false, backdrop: 'static'});
            break;
          }
        }
    }
    function onComplete(event, xhr, settings) {
        switch (xhr.status){
            //create
            case 201:{
                $('#modal').modal('hide');
                break;
            }
            //update & delete
            case 202:{
                $('#modal').modal('hide');
                break;
            }
        }
    }
    function onSuccess(event, xhr, settings) {
        switch (xhr.status){
            case 200:
                break;
            case 201:{
                //show_notif(xhr.responseJSON);
            }
            case 202:{
                show_notif(xhr.responseJSON);
            }
        }
    }
    function onError(event, xhr, settings, err) {
        switch (xhr.status){
            //message error delete
            case 501:{
                show_notif(xhr.responseJSON);
                break;
            }
            //mesage form validation
            case 422:{
                if(typeof xhr.responseJSON !== "undefined"){
                    $.each(xhr.responseJSON, function(key, val){
                        var opts = {
                            type: "error",
                            title: "",
                            text: val
                        };
                        show_notif(opts);
                        if(key){
                            $("input[name='"+key+"']").parents('.form-group').addClass('has-error');
                            $("select[name='"+key+"']").parents('.form-group').addClass('has-error');
                            var errorJenis = '<span class="help-block"><strong>'+val+'</strong></span>';
                            $(errorJenis).insertAfter($("input[name='"+key+"']"));
                            $(errorJenis).insertAfter($("select[name='"+key+"']"));
                        }
                    })
                }
                break;
            }
        }
    }
</script>

@stack('js')

</body>
</html>
