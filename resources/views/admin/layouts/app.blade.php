<!DOCTYPE html>
<html lang="en">
<head>

    @include('admin.includes.header')
    
    <title>Admin | @yield('pageTitle')</title>
    
    @include('admin.includes.header_scripts')

</head>
<body>

<section class="fixleftmenu">
    @include('admin.includes.left_sidebar')
</section>


<section class="rightpart">
    @include('admin.includes.top_nav_bar')
    <div class="content">
        <div class="infobox white-bg">
            <div class="panel-body">

                @yield('content')

            </div>
        </div>
    </div>
</section>

<!-- modal -->
 
    @yield('modal_content')

</body>
<!-- start js -->
@include('admin.includes.footer')
@include('admin.includes.footer_scripts')

</html>