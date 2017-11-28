@extends('admin.layouts.app')

@section('pageTitle', 'Users')

@section('content')

				<div class="filter_form clearfix">
					<div class="form-group pull-left ml_0 clearfix">
						<select class="form-control arrowicon">
							<option>All Users</option>
						</select>
						<i class="fa fa-chevron-down"></i>
					</div>


					<div class="form-group searchinput pull-left">
						<input type="text" name="" class="form-control" placeholder="Search ...">
						<button class="btn btn-default"><i class="fa fa-search"></i></button>
					</div>
					<button type="button" data-toggle="modal" data-target="#usercreatemodal"  class="btn btn-default btn-lg addnewcatebtn text-white pull-right">CREATE A NEW USER</button>
				</div><!-- filter and search ]]-->

				<div class="cstable">
				    <table class="table">
				        <thead>
				            <tr>
				                <th>ID</th>
				                <th>Full Name</th>
				                <th>Email</th>
				                <th>Type</th>
				                <th>Status</th>
				                <th>Joining date</th>
				                <th></th>
				            </tr>
				        </thead>
				        <tbody>
				            <tr>
				                <td>01</td>
				                <td>Lilly ramirez</td>
				                <td>Katelin.dis@ff.com</td>
				                <td>Administration</td>
				                <td><span class="text-success">Active</span></td>
				                <td>26 August 2017</td>
				                <td><strong><a href="{!! admin_url('edit-user') !!}">VIEW</a></strong></td>
				            </tr>
				            <tr>
				                <td>01</td>
				                <td>Lilly ramirez</td>
				                <td>Katelin.dis@ff.com</td>
				                <td>Administration</td>
				                <td><span class="text-success">Active</span></td>
				                <td>26 August 2017</td>
				                <td><strong><a href="{!! admin_url('edit-user') !!}">VIEW</a></strong></td>
				            </tr>
				            <tr>
				                <td>01</td>
				                <td>Lilly ramirez</td>
				                <td>Katelin.dis@ff.com</td>
				                <td>Administration</td>
				                <td><span class="text-success">Active</span></td>
				                <td>26 August 2017</td>
				                <td><strong><a href="{!! admin_url('edit-user') !!}">VIEW</a></strong></td>
				            </tr>
				            <tr>
				                <td>01</td>
				                <td>Lilly ramirez</td>
				                <td>Katelin.dis@ff.com</td>
				                <td>Administration</td>
				                <td><span class="text-success">Active</span></td>
				                <td>26 August 2017</td>
				                <td><strong><a href="{!! admin_url('edit-user') !!}">VIEW</a></strong></td>
				            </tr>
				            <tr>
				                <td>01</td>
				                <td>Lilly ramirez</td>
				                <td>Katelin.dis@ff.com</td>
				                <td>Administration</td>
				                <td><span class="text-success">Active</span></td>
				                <td>26 August 2017</td>
				                <td><strong><a href="{!! admin_url('edit-user') !!}">VIEW</a></strong></td>
				            </tr>
				            <tr>
				                <td>01</td>
				                <td>Lilly ramirez</td>
				                <td>Katelin.dis@ff.com</td>
				                <td>Administration</td>
				                <td><span class="text-success">Active</span></td>
				                <td>26 August 2017</td>
				                <td><strong><a href="{!! admin_url('edit-user') !!}">VIEW</a></strong></td>
				            </tr>
				            
				        </tbody>
				    </table>
				</div>

@endsection

<!-- modal -->
@section('modal_content') 

<div class="modal fade usermodal" id="usercreatemodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
    	<div class="panel-body">
    	 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	 <h1>Create new user</h1>
    	 <div class="row">
	    	 <div class="form-group col-sm-6">
	    	 	<label>First name</label>
	    	 	<input type="text" class="form-control" name="" placeholder="John" value="Filmonea">
	    	 </div>
	    	 <div class="form-group col-sm-6">
	    	 	<label>Last name</label>
	    	 	<input type="text" class="form-control" placeholder="Doe" name="" value="Tromp">
	    	 </div>
	    	 <div class="form-group col-xs-12">
	    	 	<label>Email</label>
	    	 	<input type="text" class="form-control" placeholder="john.doe@domain.com" name="" value="uttam@techonoexponent.com">
	    	 </div>
    	 </div>
    	 <div class="gpmt30 clearfix replbtn">
    	 <label class="icocheck pull-left">
    	 	<input type="checkbox" class="hidden" name="">
    	 	<div class="icoi">
    	 		<i class="fa fa-square" aria-hidden="true"></i>
    	 		<i class="fa fa-check-square" aria-hidden="true"></i>
    	 	</div>
    	 	Generate temporary password for this user
    	 </label>
		<button class="btn btn-primary pull-right">Save</button>
    	 <button class="btn btn-default pull-right cancelbtnsp">Cancel</button>
		</div>


    	</div>
    </div>
  </div>
</div>

@endsection
