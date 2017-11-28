<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="description" content="">

<meta name="author" content="">

<title>Welcome to bazer</title>
<?php echo $header_scripts; ?>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/tel_num/intlTelInput.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/lightbox/fancybox.css') }}" />
<link rel="stylesheet" type="text/css" href="<?php echo DEFAULT_ASSETS_URL; ?>css/jquery.Jcrop.css">
</head>



<body id="page-top">

<header id="headerInner">
     <?php echo $header_top; ?>
</header>

<!--START MAIN BODY-->
<section class="spacer"></section>
<section id="mainContainer" class="myAccountPage">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="formTtl">Alert message</h2>
            <div class="myAccountContainer" style="padding:10px;">
                
                <div class="myAccountMain">
                    <?php echo $msg; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end  section--> 

<footer id="footer">
<?php echo $footer; ?>
</footer>

<?php echo $footer_scripts; ?>
<script src="{!! asset('assets/frontend/tel_num/intlTelInput.min.js') !!}" type="text/javascript"></script>

<script src="{!! asset('assets/frontend/js/tel_num.js') !!}" type="text/javascript"></script>
<style type="text/css">
	#phone{width: 300px;}
</style>
<script src="{!! asset('assets/frontend/lightbox/jquery.fancybox.js') !!}" type="text/javascript"></script>
<script type="text/javascript">
$(".fancybox").fancybox({
	type :'ajax'
});	
</script>
</body>
</html>