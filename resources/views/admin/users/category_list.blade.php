@extends('admin.layouts.app')

@section('pageTitle', 'Users')

@section('content')

<div class="clearfix panel-body">
	<h2 class="subtitle pull-left">All Categories</h2>
	<button class="btn btn-info btn-lg addnewcatebtn  pull-right">CREATE NEW CATEGORY</button>
</div><!-- filter and search ]]-->

<div class="cstable">
    <table class="table">
        <thead>
            <tr>
                <th>CATEGORY</th>
                <th>SUB-CATEGORIES</th>
                <th>STATUS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Design & Creative</td>
                <td>Logo Design, Illustration & Graphics, Website Design, T-shirt & Clothing, 3D Design, Brochure, Flyer</td>
                <td>Active</td>
                <td><strong><a  type="button" data-toggle="modal" data-target="#categorymodal" href="javascript:void(0);">VIEW</a></strong></td>
            </tr>
            <tr>
                <td>Design & Creative</td>
                <td>Logo Design, Illustration & Graphics, Website Design, T-shirt & Clothing, 3D Design, Brochure, Flyer</td>
                <td>Active</td>
                <td><strong><a  type="button" data-toggle="modal" data-target="#categorymodal" href="javascript:void(0);">VIEW</a></strong></td>
            </tr>
            <tr>
                <td>Design & Creative</td>
                <td>Logo Design, Illustration & Graphics, Website Design, T-shirt & Clothing, 3D Design, Brochure, Flyer</td>
                <td>Active</td>
                <td><strong><a  type="button" data-toggle="modal" data-target="#categorymodal" href="javascript:void(0);">VIEW</a></strong></td>
            </tr>
            <tr>
                <td>Design & Creative</td>
                <td>Logo Design, Illustration & Graphics, Website Design, T-shirt & Clothing, 3D Design, Brochure, Flyer</td>
                <td>Active</td>
                <td><strong><a  type="button" data-toggle="modal" data-target="#categorymodal" href="javascript:void(0);">VIEW</a></strong></td>
            </tr>
            <tr>
                <td>Design & Creative</td>
                <td>Logo Design, Illustration & Graphics, Website Design, T-shirt & Clothing, 3D Design, Brochure, Flyer</td>
                <td>Active</td>
                <td><strong><a  type="button" data-toggle="modal" data-target="#categorymodal" href="javascript:void(0);">VIEW</a></strong></td>
            </tr>
            <tr>
                <td>Design & Creative</td>
                <td>Logo Design, Illustration & Graphics, Website Design, T-shirt & Clothing, 3D Design, Brochure, Flyer</td>
                <td>Active</td>
                <td><strong><a  type="button" data-toggle="modal" data-target="#categorymodal" href="javascript:void(0);">VIEW</a></strong></td>
            </tr>
            <tr>
                <td>Design & Creative</td>
                <td>Logo Design, Illustration & Graphics, Website Design, T-shirt & Clothing, 3D Design, Brochure, Flyer</td>
                <td>Active</td>
                <td><strong><a  type="button" data-toggle="modal" data-target="#categorymodal" href="javascript:void(0);">VIEW</a></strong></td>
            </tr>
        </tbody>
    </table>
</div>

@endsection

<!-- modal -->
@section('modal_content') 

<div class="modal fade categorymodal" id="categorymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      	<div class="dropdown dropeclip pull-right">
		  <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    <i class="fa fa-ellipsis-h"></i>
		  </button>
		  <ul class="dropdown-menu" aria-labelledby="dLabel">
		    <li><a href="#">Lorem ipsum</a></li>
		    <li><a href="#">Lorem ipsum</a></li>
		    <li><a href="#">Lorem ipsum</a></li>
		  </ul>
		</div>

        
      </div>
      <div class="modal-body">
      	<h3 class="subtitle">Category name</h3>
      	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection
