@extends('layouts.app')
@section('title')
Job bidding | Job Chats
@endsection


@section('content')
<!--<div class="mainBody dashboard-container">-->
<div class="mainSite innerpage">

@include('layouts.jobs_common_header')

<section class="container taskcontent msg_page">
	<div class="task_title_wrap clearfix">
		<div class="task_titel pull-left">			
			Add your project assets here <small>(Fonts, Images, Branding etc)</small>
		</div>
		<div class="pull-right">
        <a href="{{ URL::previous() }}"><button type="button" class="btn btn-default addfilebtn">Back</button></a>
		<button type="button" data-toggle="modal" data-target="#newfolderModal" class="btn btn-default addfilebtn"><img src="{!! asset('assets/frontend/images/new_folder.png') !!}" class="img-responsive inline-block">&nbsp;&nbsp;CREATE A NEW FOLDER</button>
		<button type="button" data-toggle="modal" data-target="#newfileModal" class="btn btn-default addfilebtn"><img src="{!! asset('assets/frontend/images/plus.png') !!}" class="img-responsive inline-block">&nbsp;&nbsp;ADD A NEW FILE</button>
		</div>
    </div>

   <div class="table-responsive tableforfile">
   		<table class="table">
   			<thead>
   				<tr>
   					<th>NAME</th>
   					<th>KIND</th>
   					<th>MODIFIED</th>
   				</tr>
   			</thead>
   			<tbody>
                @if(count($jobAsssetDetails) > 0)
                    @foreach($jobAsssetDetails as $asset)
           				<tr>
           					<td>
           						<div class="clearfix">
                                    @if($asset->is_file == 1)
                                        <img src="{!! asset('assets/frontend/images/image_icon.png') !!}" class="img-responsive pull-left">
                                    @else 
           							  <img src="{!! asset('assets/frontend/images/source_file.png') !!}" class="img-responsive pull-left">
                                    @endif
                                    @if($asset->is_file == 1)
                                        <div class="pull-left textwithicon">{{ $asset->name }}</div>
                                    @else 
                                      <div class="pull-left textwithicon"><a href="{{ url('/jobs/job-assets/'.$job_id.'/'.$asset->id) }}">{{ $asset->name }}</a></div>
                                    @endif
           							
           						</div>

           					</td>
           					<td>{{ $asset->is_file == '0' ? "Folder" : "File" }}</td>
           					<td>{{ date_format($asset->updated_at,"d M Y, H:i") }}</td>
                            <td>&nbsp;
                                @if($asset->is_file == 1)
                                    <a href="{{ url('/jobs/download-asset-file/'.$asset->id) }}" >Download</a>
                                @endif
                            </td>
           			    </tr>
                    @endforeach
                @else
                    <tr>
                        <td>
                            <div class="clearfix">
                                No file/folder found
                            </div>

                        </td>
                    </tr>
                @endif
   			</tbody>
   		</table>
   </div>
   <nav aria-label="..." class="paginationew text-right">
    {{ $jobAsssetDetails->render() }}
  </nav>
</section>
</div>
@endsection


@section('customScript')
<form action="{{ url('jobs/create-asset-file/'.$job_id.'/'.$parent_id) }}" method="post" id="createJobFile" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="modal fade" id="newfileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ADD A NEW FILE</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
                <input type="file" class="form-control" name="asset_file" id="asset_file" >
        </div>
      </div>
      <div class="modal-footer">
        <input class="btn btn-primary" value="Save" type="submit">
      </div>
    </div>
  </div>
</div>
</form>
<form action="{{ url('jobs/create-asset-folder/'.$job_id.'/'.$parent_id) }}" method="post" id="createJobFolder" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="modal fade" id="newfolderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">CREATE A NEW FOLDER</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <input type="text" class="form-control" name="name" id="name" required>
            <input type="hidden" class="form-control" name="is_file" id="is_file" value="0">
        </div>
      </div>
      <div class="modal-footer">
        <input class="btn btn-primary" value="Save" type="submit">
      </div>
    </div>
  </div>
</div>
</form>
<script>
$(document).ready(function(){
    $("#tomarkstar").click(function(){
        $("#iclass").toggleClass("fa-star");
    });
});

$(document).ready(function(){
    $("#tomarkstar2").click(function(){
        $("#iclass2").toggleClass("fa-star");
    });
});

$(document).ready(function(){
    $("#tomarkstar3").click(function(){
        $("#iclass3").toggleClass("fa-star");
    });
});

$(document).ready(function(){
    $("#tomarkstar4").click(function(){
        $("#iclass4").toggleClass("fa-star");
    });
});
</script>

@endsection