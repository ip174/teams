<!-- START CONTENT SECTION -->
<section style="background-image:url('{{asset('assets/frontend/images/banner_2.jpg')}}'); background-color:#1E2E42; background-attachment:fixed;" class=" bg-master-lighter sm-no-margin no-overflow subscribesec" data-pages-bg-image="" data-bg-overlay="#1E2E42" data-overlay-opacity="0.8" data-pages="parallax">
<div style="background-color: rgba(30, 46, 66, 0.8)">
<div class="container p-b-40 p-t-40">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <h1 class="text-white text-center m-t-5 substite">What are you waiting for?</h1>
      <div class="m-t-30center-block"> 

      	<!-- <img src="{{asset('assets/frontend/images/getstartedemail2.svg')}}" class=" p-t-20 col-sm-10 col-sm-offset-1" ></img><br>
 -->
			<div class="center-block forms2 formsucreibe clearfix">
	            <form action="" method="post">
              <div class="col-sm-8">
	              <input type="email" class="form-control" placeholder="Enter your email..." id="hirer_SubscriptionEmail" name="hirer_SubscriptionEmail1" required>
                <br />
                <span class="msg1"></span>
	            </div>
	            <div class="col-sm-4 form-group">
	              <input type="button" value="Get Started - It's Free" class="btn btn-success btn-block " onclick="openRegister()">
	            </div>
            </form>
          </div>      	
        <p class="hint-text p-t-0 text-white text-center p-t-10 subspara"><i>You can be a hirer, a collaborator or both at the same time!</i></p>
      </div>
    </div>
  </div>
</div>
</section>
<!-- END CONTENT SECTION --> 
<script type="text/javascript">
  function openRegister(){
    var email = document.getElementById('hirer_SubscriptionEmail').value;
    window.open('/register?email='+email, '_self');
  }
  
</script>