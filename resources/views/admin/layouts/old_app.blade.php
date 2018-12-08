<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | @yield('pageTitle')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{!! asset('assets/admin/bootstrap/css/bootstrap.min.css') !!}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! asset('assets/admin/font-awesome/css/font-awesome.min.css') !!}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{!! asset('assets/admin/ionicons/css/ionicons.min.css') !!}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{!! asset('assets/admin/dist/css/AdminLTE.min.css') !!}">
    {{--AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load.--}}
    <link rel="stylesheet" href="{!! asset('assets/admin/dist/css/skins/skin-blue.min.css') !!}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{!! asset('assets/admin/plugins/iCheck/flat/blue.css') !!}">

    <!-- Date Picker -->
    <link rel="stylesheet" href="{!! asset('assets/admin/plugins/datepicker/datepicker3.css') !!}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{!! asset('assets/admin/plugins/daterangepicker/daterangepicker-bs3.css') !!}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{!! asset('assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') !!}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{!! asset('assets/admin/plugins/datatables/dataTables.bootstrap.css') !!}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2/select2.min.css') !!}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{!! asset('assets/admin/dist/css/style.css') !!}">
	<!-- dataTables CSS -->
	<link rel="stylesheet" href="{!! asset('assets/admin/dataTables/css/dataTables.bootstrap.min.css') !!}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('customStyles')
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="{!! url('admin/dashboard') !!}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>DM</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Admin</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{!! asset('assets/admin/dist/img/avatar5.png') !!}" class="user-image" alt="User Image">
                                <span class="hidden-xs">Admin</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="{!! asset('assets/admin/dist/img/avatar5.png') !!}" class="img-circle" alt="User Image">
                                    <p>Admin</p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="{!! admin_url('logout') !!}" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            @include('admin.layouts.sidebar')
        </aside>

        @yield('content')

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.5.4
            </div>
            <strong>Copyright &copy; {{ date("Y") }}
                <a href="https://www.technoexponent.com">Techno Exponent</a>.
            </strong> All rights reserved.
        </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="{!! asset('assets/admin/plugins/jQuery/jQuery-2.1.4.min.js') !!}"></script>
	
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- ckeditor -->
    <script src="{!! asset('assets/admin/ckeditor/ckeditor.js') !!}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{!! asset('assets/admin/bootstrap/js/bootstrap.min.js') !!}"></script>

    <!-- Slimscroll -->
    <script src="{!! asset('assets/admin/plugins/slimScroll/jquery.slimscroll.min.js') !!}"></script>

    <script src="{!! asset('assets/admin/dist/js/app.min.js') !!}"></script>

    <script src="{!! asset('assets/admin/dist/js/demo.js') !!}"></script>

    <!-- DataTables -->
    <script src="{!! asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/admin/plugins/datatables/dataTables.bootstrap.min.js') !!}"></script>

    <!-- Select2 -->
    <script src="{!! asset('assets/admin/plugins/select2/select2.min.js') !!}"></script>

    <!-- FastClick -->
    <!--<script src="{!! asset('assets/admin/plugins/fastclick/fastclick.min.js') !!}"></script>-->
	<!--PlugIn for jquery multiselect start-->
	<!--<link rel="canonical" href="https://github.com/dbrekalo/fastselect/"/>
	<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/dbrekalo/attire/dist/css/build.min.css">
	<script src="https://cdn.jsdelivr.net/gh/dbrekalo/attire/dist/js/build.min.js"></script>-->
	<link rel="stylesheet" href="{!! asset('assets/frontend/multiple_autocomplete/dist/fastselect.min.css') !!}">
	<script src="{!! asset('assets/frontend/multiple_autocomplete/dist/fastselect.standalone.js') !!}"></script>
	<!--PlugIn for jquery multiselect end-->
	
	<!--Code for jquery multiselect start-->
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-69265879-1', 'auto');
	ga('send', 'pageview');

	$('.multipleSelect').fastselect();
	</script>
	<!--Code for jquery multiselect end-->
	
    <script type="text/javascript">
        window.setTimeout(function() {
            $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);

    </script>
	
	
	<!--Code for data tables-->
	<!--<script src="{!! asset('assets/admin/dataTables/js/jquery.dataTables.min.js') !!}"></script>
	<script src="{!! asset('assets/admin/dataTables/js/dataTables.bootstrap.min.js') !!}"></script>
	<script>
	$(function () {
		$('#example2').DataTable({
			'paging'      : true,
			'lengthChange': false,
			'searching'   : false,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : false
		})
	});
	</script>-->
	<!--Code for data tables-->
	
	
    @yield('customScript')

</body>
</html>