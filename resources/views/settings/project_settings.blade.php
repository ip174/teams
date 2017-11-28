@extends('layouts.app')
@section('title')
Job bidding | Job Chats
@endsection


@section('content')
@php
$weekdays = config("constants.WEEKDAYS");
@endphp
<!--<div class="mainBody dashboard-container">-->
<div class="mainSite innerpage">
@include('layouts.jobs_common_header')

<section class="container">
	<div class="task_title_wrap clearfix">
		<div class="task_titel pull-left">			
			Settings
		</div>
		<div class="line_gp"></div>		
    </div>

    <div class="infobox clearfix settingtab white-bg">

    	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
    		<div class="panel-body">
    			<!-- Nav tabs -->
			    <ul class="nav nav-tabs" role="tablist">
			      <li role="presentation" class="active"><a href="#notification" aria-controls="notification" role="tab" data-toggle="tab"><span><i class="fa fa-cog"></i></span>Project Settings</a></li>
			      <!--<li role="presentation"><a href="#notification" aria-controls="notification" role="tab" data-toggle="tab"><span><i class="fa fa-bell"></i></span>Notification</a></li>
			      <li role="presentation"><a href="#privacy" aria-controls="privacy" role="tab" data-toggle="tab"><span><i class="fa fa-lock"></i></span>Privacy</a></li>
			      <li role="presentation"><a href="#NDSA" aria-controls="NDSA" role="tab" data-toggle="tab"><span><i class="fa fa-file-text-o"></i></span>NDAs</a></li>
			      <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><span><i class="fa fa-gbp"></i></span>Payments</a></li>-->
			    </ul>
    		</div>

    	</div><!-- col ]] -->
    	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

    		<div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="home">
			    <div class="panel-body">
    				<h2 class="catetitle">Project Settings</h2>
    				
    				<form action="{{ url('/settings/save-project-settings') }}" method="post" accept-charset="utf-8">
    					{{ csrf_field() }}
    					<input type="hidden" name="job_id" value="{{ $job_id }}">
    					<input type="hidden" name="id" value="{{ isset($projectSettings->id) ? $projectSettings->id : '' }}">
    					<ul class="list-unstyled contlist">
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Working days</label>
	    						</div>
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 clearfix">
	    							<p class="para pull-left">
		    							<select name="working_days_from" class="form-control">
		    								<option value=""> -Select- </option>
		    								@foreach($weekdays as $eachdaysKey => $eachdaysVal)
		    								<option value="{{ $eachdaysKey }}" {{ isset($projectSettings->working_days_from) && $projectSettings->working_days_from == $eachdaysKey ? 'selected' : '' }}> {{ $eachdaysVal }} </option>
		    								@endforeach
		    							</select>
	    							</p>
	    						</div>
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 clearfix">
	    							<p class="para pull-left">
		    							<select name="working_days_to" class="form-control">
		    								<option value=""> -Select- </option>
		    								@foreach($weekdays as $eachdaysKey => $eachdaysVal)
		    								<option value="{{ $eachdaysKey }}" {{ isset($projectSettings->working_days_to) && $projectSettings->working_days_to == $eachdaysKey ? 'selected' : '' }}> {{ $eachdaysVal }} </option>
		    								@endforeach
		    							</select>
	    							</p>
	    						</div>
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 clearfix">
	    							<button type="submit" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>UPDATE</button>
	    						</div>
	    					</li><!-- clearfix -->

	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Working Hours</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left"><input type="text" name="working_hours" value="{{ isset($projectSettings->working_hours) ? $projectSettings->working_hours : '' }}" class="form-control"></p>
	    							<button type="submit" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>UPDATE</button>
	    						</div>
	    					</li><!-- clearfix -->
	    				</ul>
    				</form>
    				</div>
			    </div>
			    <div role="tabpanel" class="tab-pane" id="profile">...</div>
			    <div role="tabpanel" class="tab-pane" id="messages">...</div>
			    <div role="tabpanel" class="tab-pane" id="settings">...</div>
		  </div>

    	</div><!--  col ]] -->

    </div>

    

</section>
</div>
@endsection


@section('customScript')
<script>
$(document).ready(function(){
    $("#opentask").click(function(){
        $(".taskcontent").toggleClass("open");
    });

    
});
</script>
@endsection