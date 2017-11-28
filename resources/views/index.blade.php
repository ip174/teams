@extends('layouts.app')
@section('title')
Job bidding
@endsection
@section('content') 

<!--  <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" /> -->
<link class="main-stylesheet" href="{{asset('assets/frontend/forhome/css/pages.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/frontend/pages/css/forhome-icons.css" rel="stylesheet')}}" type="text/css" />
<link class="main-stylesheet" href="{{asset('assets/frontend/forhome/css/icofont.css')}}" rel="stylesheet" type="text/css" />

<!-- BEGIN CONTENT SECTION -->
<section class=" p-b-10  full-width bg-white">
  <div class="container-xs-height full-height">
    <div class="col-xs-height col-middle text-left"> 
      <!-- BEGIN CONTENT -->
      <div class="inner full-height">
        <div class="container-xs-height full-height">
          <div class="col-xs-height col-middle">
            <div class="container">
              <div class="row">
                <div class="col-md-6 ">
                  <h1 class="light m-t-40 text-left " data-swiper-parallax="-15%">Let’s bring work to people –
                    not people to work </h1>
                  <h4 class="m-t-15 sm-text-left text-left">Here’s where it happens: <br>
                    Businesses get hiring and Professionals get hired! <br>
                  </h4>
                  <div class="watchvideo">
                  	<a class="text-video" href="javascript:void(0);"><img class="img-responsive inline-block" src="{{asset('assets/frontend/images/watchvideo_ico.png')}}">&nbsp;&nbsp;Watch Video</a>
                  </div>
                  
                  <p class="p-t-20 fs-16 hint-text"><i>You can be a hirer, a collaborator or both at the same time!</i></p>
                  <form action="" method="post">
                  <div class="row formsucreibe">
                    <div class="col-sm-7">
                      <input type="email" class="form-control" placeholder="Enter your email..." name="hirer_SubscriptionEmail" id="hirer_SubscriptionEmail" required style="border:1px solid #61c46e;"><br />
                      <span class="msg"></span>
                    </div>
                    <div class="col-sm-5 form-group">
                      <input type="button" value="Get Started - It's Free" class="btn btn-success btn-block submitBtn" onClick="openRegister()">
                    </div>
                  </div>
                  </form>
                </div>
                <div class="col-sm-6"> <img src="{{asset('assets/frontend/images/hero-collaboration-partial.png')}}" class="image-responsive-width  m-t-15  md-image-responsive-height" data-pages="float" alt=""> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END CONTENT --> 
    </div>
  </div>
</section>
<!-- END CONTENT SECTION --> 

<!-- BEGIN CONTENT SECTION -->
<section class="bg-master-light relative  p-b-10 p-t-30">
  <div class="container ">
    <div class="md-p-l-20 xs-no-padding clearfix">
      <div class="col-sm-3 no-padding">
        <div class="p-r-30 md-p-r-30 xs-no-padding text-center"> <a class="nicoh" href="{{ url('/jobs/post-jobs') }}" > <img alt="" class="m-b-10" src="{{asset('assets/frontend/images/iconh.png')}}" /></a><!-- <a class="swap" href="{{ url('/jobs/post-jobs') }}" > <img alt="" class="m-b-10" src="{{asset('assets/frontend/images/hire.png')}}" /> <img alt="" class="m-b-10" src="{{asset('assets/frontend/images/hire2.png')}}" /></a> -->
          <h5 class="block-title"><a href="{{ url('/jobs/post-jobs') }}" class="text-primary">POST A JOB</a></h5>
          <p class="m-t-10 fs-14 font-arial small">Post your project, receive proposals from professionals within minutes, shortlist and hire the right collaborator</p>
        </div>
        <div class="visible-xs b-b b-grey-light m-t-30 m-b-30"></div>
      </div>

      <div class="col-sm-3 no-padding">
        <div class="p-r-30 md-p-r-30 xs-no-padding text-center"> <a class="nicoh" href="{{ url('/jobs/post-jobs') }}" > <img alt="" class="m-b-10" src="{{asset('assets/frontend/images/iconh2.png')}}" /></a><!-- <a class="swap" href="{{ url('/jobs/search-jobs') }}" > <img alt="" class="m-b-10" src="{{asset('assets/frontend/images/hire.png')}}" /> <img alt="" class="m-b-10" src="{{asset('assets/frontend/images/hire2.png')}}" /></a> -->
          <h5 class="block-title"><a href="{{ url('/jobs/search-jobs') }}" class="text-primary">Find work</a></h5>
          <p class="m-t-10 fs-14 font-arial small">Search and find a job or project online. Work with your choice of employer as full-time, part-time or a freelancer</p>
        </div>
        <div class="visible-xs b-b b-grey-light m-t-30 m-b-30"></div>
      </div>

      <div class="col-sm-3 no-padding">
        <div class="p-r-30 md-p-r-30  xs-no-padding text-center"> <a class="nicoh" href="{{ url('/jobs/post-jobs') }}" > <img alt="" class="m-b-10" src="{{asset('assets/frontend/images/iconh3.png')}}" /></a> <!-- <a class="swap" href="javascript:void(0);" > <img alt="" class="m-b-10" src="{{asset('assets/frontend/images/hire.png')}}" /> <img alt="" class="m-b-10" src="{{asset('assets/frontend/images/hire2.png')}}" /></a> -->
          <h5 class="block-title"><a href="javascript:void(0);" class="text-primary">COLLABORATE</a></h5>
          <p class="m-t-10 fs-14 font-arial small">Our dedicated workstream has a bespoke set of tools that make collaboration a breeze</p>
        </div>
        <div class="visible-xs b-b b-grey-light m-t-30 m-b-30"></div>
      </div>

      <div class="col-sm-3 no-padding">
        <div class="p-r-30 md-p-r-30  xs-no-padding text-center"> <a class="nicoh" href="{{ url('/jobs/post-jobs') }}" > <img alt="" class="m-b-10" src="{{asset('assets/frontend/images/iconh4.png')}}" /></a><!-- <a class="swap" href="{{ url('/freelancers/search-freelancers') }}" > <img alt="" class="m-b-10" src="{{asset('assets/frontend/images/hire.png')}}" /> <img alt="" class="m-b-10" src="{{asset('assets/frontend/images/hire2.png')}}" /></a> -->
          <h5 class="block-title">
          <a href="{{ url('/freelancers/search-freelancers') }}" class="text-primary">FIND PEOPLE</a>
          </h6>
          <p class="m-t-10 fs-14 font-arial small">There are matches for your specific needs in our database – people who really know the value of collaboration</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- END CONTENT SECTION --> 

<!-- BEGIN INTRO CONTENT -->
<section class="bg-white p-b-60 p-t-60" id="notifications">
  <div class="container">
    <div class="row">
      <div class="col-sm-6"> <img src="{{asset('assets/frontend/images/post_a_job.png')}}" width="100%" class="image-responsive-width sm-image-responsive-height" alt=""> </div>
      <div class="col-sm-5 col-sm-offset-1  sm-p-t-0">
        <h1 class="m-t-5">Outsource a job</h1>
        <p class="m-t-30 fs-18">Post it – receive prompt proposals from professionals – then hire your perfect project partner, or as we prefer, ‘collaborator’… </p>
        <p class="fs-15 m-t-15 text-menu">Using our network, in minutes you can find talented collaborators who will add value to your operation. It’s a new way of forging open and cooperative working relationships that are truly ‘win-win’… </p>
        <p class="fs-15 m-t-25 text-menu"><a href="javascript:void(0);" class="text-primary font-montserrat"><strong><u>Post your project now</u></strong></a> – receive competitive proposals</p>
      </div>
    </div>
  </div>
</section>
<!-- END INTRO CONTENT --> 

<!-- BEGIN CONTENT SECTION -->
<section class="bg-master-light p-t-100 p-b-100 ">
  <div class="container-xs-height full-height">
    <div class="col-xs-height col-middle text-left"> 
      <!-- BEGIN CONTENT -->
      <div class="inner full-height">
        <div class="container-xs-height full-height">
          <div class="col-xs-height col-middle">
            <div class="container">
              <div class="row">
                <div class="col-sm-6">
                  <h1 class="m-t-5 ">Find a job</h1>
                  <p class="fs-18 m-t-30 ">See who’s out there hiring – whether it’s for full-time, part-time or freelance work – and collaborate with them on their assignment… </p>
                  <p class="fs-15 m-t-15 text-menu">It can be lonely out there, relying on one-off jobs and paying high commissions to agencies – especially when you don’t have a lot of commendations so far. We understand – we’ve been there too.  <br>
                    So we offer you:<br>
                    <ul class="withbullet" style="padding-left: 18px !important;">
                      <li class="fs-15 font-open-sans m-t-5 text-menu">A better  chance of getting hired</li>
                      <li class="fs-15 font-open-sans m-t-5 text-menu">More of your hard-won earnings</li>
                      <li class="fs-15 font-open-sans m-t-5 text-menu ">Greater satisfaction from working with, and bouncing off, others</li>
                      <li class="fs-15 font-open-sans m-t-5 text-menu">Genuinely flexible working</li>
                      <li class="fs-15 font-open-sans m-t-5 text-menu">Better work/life balance</li>
                    </ul>
                  <p class="fs-15 m-t-25 text-menu"><a href="javascript:void(0);" class="text-primary font-montserrat"><strong><u>Register today</u></strong></a> – improve your future prospects</p>
                </div>
                <div class="col-sm-6 "> <img src="{{asset('assets/frontend/images/find_a_job.png')}}" width="100%" class="image-responsive-width md-image-responsive-height center-block" alt=""> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END CONTENT --> 
    </div>
  </div>
</section>
<!-- END CONTENT SECTION --> 

<!-- BEGIN INTRO CONTENT -->
<section class="bg-white p-b-60 p-t-60" id="notifications">
  <div class="container">
    <div class="row">
      <div class="col-sm-6"> <img src="{{asset('assets/frontend/images/hire_collaborator.png')}}" width="100%" class="image-responsive-width sm-image-responsive-height" alt=""> </div>
      <div class="col-sm-5 col-sm-offset-1  sm-p-t-0">
        <h1 class="m-t-5 p-t-10">Hire a collaborator</h1>
        <p class="m-t-30 fs-18">There are matches for your specific needs in the unique Teams Network database – people who really know the value of collaboration… </p>
        <p class="fs-15 m-t-15 text-menu">We offer carefully-curated individuals, arranged in logical categories and complete with details of their specialities, qualifications, experience and ratings from previous hirers. 
          View or listen to work that they have posted; then make an informed decision based on their submissions and their understanding of your requirements. </p>
        <p class="fs-15 m-t-25 text-menu"><a href="javascript:void(0);" class="text-primary font-montserrat"><u>Get a free quote</u></a> – there’s nothing to lose, and a lot to gain</strike></p>
      </div>
    </div>
  </div>
</section>
<!-- END INTRO CONTENT --> 

<!-- BEGIN CONTENT SECTION -->
<section class="bg-master-light p-t-100 p-b-100 ">
  <div class="container-xs-height full-height">
    <div class="col-xs-height col-middle text-left"> 
      <!-- BEGIN CONTENT -->
      <div class="inner full-height">
        <div class="container-xs-height full-height">
          <div class="col-xs-height col-middle">
            <div class="container">
              <div class="row">
                <div class="col-sm-6">
                  <h1 class="m-t-5 ">Manage assignments</h1>
                  <p class="m-t-30 fs-18">Our dedicated workstream has a bespoke set of tools that make collaboration a breeze – unlock your potential, immediately… </p>
                  <p class="fs-15 m-t-15 text-menu">See how online remote working can be more efficient than you ever imagined. Control the whole process and benefit from:
                    <ul class="withbullet" style="padding-left: 18px !important;">
                      <li class="fs-15 font-open-sans m-t-5 text-menu">Budgetary control</li>
                      <li class="fs-15 font-open-sans m-t-5  text-menu ">Hiring management</li>
                      <li class="fs-15 font-open-sans m-t-5  text-menu ">Inter-team communication</li>
                      <li class="fs-15 font-open-sans m-t-5  text-menu">Greater productivity</li>
                      <li class="fs-15 font-open-sans m-t-5  text-menu">Progress overview</li>
                      <li class="fs-15 font-open-sans m-t-5 text-menu">Live chat</li>
                    </ul>
                  <p class="fs-15 m-t-15 text-menu">and so much more… </p>
                  <p class="fs-15 m-t-25 text-menu"><a href="javascript:void(0);" class="text-primary font-montserrat"><u>Learn how it works
                    </u></a> </p>
                </div>
                <div class="col-sm-6 "> <img src="{{asset('assets/frontend/images/manage_assignment.png')}}" width="100%" class="image-responsive-width md-image-responsive-height center-block" alt=""> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END CONTENT --> 
    </div>
  </div>
</section>
<!-- END CONTENT SECTION --> 

<!-- BEGIN INTRO CONTENT -->
<section class="bg-white p-b-60 p-t-60" id="notifications">
  <div class="container">
    <div class="row">
      <div class="col-sm-6"> <img src="{{asset('assets/frontend/images/whychooseus.png')}}" class="center-block  img-responsive" alt=""> </div>
      <div class="col-sm-5 col-sm-offset-1  sm-p-t-0">
        <h1 class="m-t-5 p-t-10">Why choose us?</h1>
        <p class="m-t-30 fs-16">We foster collaborative relationships, provide transparent communication channels, and are open and fair in our charging system. The advantages are clear: </p>
        <ul class="withbullet">
          <li class="fs-15 font-open-sans m-t-5 text-menu">Honest, fair fees - Free to sign up</li>
          <li class="fs-15 font-open-sans m-t-5 text-menu">Cloud-based platform available anywhere, whenever</li>
          <li class="fs-15 font-open-sans m-t-5 text-menu">Secure and safe payment methods</li>
          <li class="fs-15 font-open-sans m-t-5 text-menu">Management collaboration workspace </li>
          <li class="fs-15 font-open-sans m-t-5 text-menu">24/7 professional customer support</li>
          <li class="fs-15 font-open-sans m-t-5 text-menu">Professional ethos &amp; support for work/life balance</li>
        </ul>
        <p class="fs-15 m-t-15 text-menu">Teams Network creates real opportunities for people to exercise their skills from remote location. For companies with projects to fulfil, Teams Network opens up a wealth of opportunity to hire talent, on demand… </p>
        <p class="fs-15 m-t-25 text-menu"><a href="javascript:void(0);" class="text-primary font-montserrat"><strong><u>Sign up now</u></strong></a> – Get started for free</p>
      </div>
    </div>
  </div>
</section>
<!-- END INTRO CONTENT --> 

@include('layouts.footer_you_are_waiting')

@endsection

@section('customScript') 
<script type="text/javascript" src="{{asset('assets/frontend/forhome/plugins/vide/jquery.vide.min.js')}}"></script> 
<script type="text/javascript">
    $(document).ready(function(){
        $("#play").click(function(){
        $(".videobox").toggleClass("open");

        
    });
});


</script> 
<script>
  // 2. This code loads the IFrame Player API code asynchronously.
  var tag = document.createElement('script');

  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  // 3. This function creates an <iframe> (and YouTube player)
  //    after the API code downloads.
  var player;
  function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
      height: '390',
      width: '640',
      videoId: 'M7lc1UVf-VE',
      events: {
        'onReady': onPlayerReady,
        'onStateChange': onPlayerStateChange
      }
    });
  }

  // 4. The API will call this function when the video player is ready.
  function onPlayerReady(event) {
    //event.target.playVideo();
    document.getElementById('play').innerHTML = '<a href="#" onclick="play();"><i class="fa fa-play" aria-hidden="true"></i></a>';
  }

  function play(){
    player.playVideo();
  }

  // 5. The API calls this function when the player's state changes.
  //    The function indicates that when playing a video (state=1),
  //    the player should play for six seconds and then stop.
  var done = false;
  function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.PLAYING && !done) {
      setTimeout(stopVideo, 6000);
      done = true;
    }
  }
  function stopVideo() {
    player.stopVideo();
  }
  
  function openRegister(){
    var email = document.getElementById('hirer_SubscriptionEmail').value;
    window.open('/register?email='+email, '_self');
  }
  
</script> 
@endsection