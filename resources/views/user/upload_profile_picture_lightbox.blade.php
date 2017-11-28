<?php
$style1 = $image_type = '';
$action = 'insert';
if($file_name != ''){
	$style1 = ' style="display:none"';
	$action = 'edit';
}
?>
<div class="editform upload-picture-form">
	<span class="uploadPopupttl">Your Profile Photo</span>
	<div>Recommended size 200 x 200</div>
	<br>
	<form class="default_form ajaxuploadform" method="post" id="upload_propic" <?php echo $style1;?>>
		{{ csrf_field() }}
        <label class="uploadNew">
			<input type="file" name="profile_pic" id="profile_pic"/>
			<div class="txt">
				<i class="fa fa-upload"></i> 
				<span>Upload New Image <small>(jpg/png)</small>
				</span>
			</div>
        </label>
    </form>
	<!-- <span class="noteMsg">Lorem ipsum dolor sit amet, consectetur adipiscing elit</span> -->
        <div class="fields" id="output" style="display:none;">
    <div class="ajaxuploadform2">
        <?php
        	if($file_name != ''){
				echo '<div align="center">
							<img src="'.asset('assets/frontend/profile_pictures').'/'.$file_name.'" id="cropbox" alt="Preview" >
					  </div>';
			}
		?>
        </div>
    </div>    
    <form id="crop_form" name="crop_form" style="display:none;" action="{{ url('user/upload-profile-picture') }}" method="post" enctype="multipart/form-data"> 
		{{ csrf_field() }}
    	<textarea name="image_file" id="image_file" style="display:none;"><?php echo $image_file;?></textarea>
        <input type="hidden" id="action" name="action" value="<?php echo $action;?>" />
        <input type="hidden" id="x" name="x" />
        <input type="hidden" id="y" name="y" />
        <input type="hidden" id="w" name="w" />
        <input type="hidden" id="h" name="h" />
        <input type="hidden" id="nWidth" name="nWidth" />
        <input type="hidden" id="nHeight" name="nHeight" />
        <input type="hidden" id="image_type" name="image_type" value="<?php echo @$file_type;?>"/>
        <input type="hidden" id="image_name" name="image_name" value="<?php echo $file_name;?>"/>
		<span id="wX"></span>
		<span id="hX"></span>
		<br>
        <div class="uploadButtonset">
			<?php /*if($file_name != ''){?>
				<a href="javascript:void(0);" id="newImage" onclick="deleteImageProcess(this);" class="trash">
					<i class="fa fa-trash-o"></i>
				</a>
			<?php }*/?>
			<div class="buttons align-right">
				<input type="submit" value="Save" class="right greenBtn btn btn-success saveBtn" style="display:none;" onclick="addLoader();">
				<?php if($file_name != ''){?>
				<input type="button" class="blackBtn btn btn-success" id="newImage" onclick="newImageProcess(this);" name="change" value="Change">
				<?php }?>
			</div>
        </div>
		<div class="alertMsg"></div>
    </form>
</div>
