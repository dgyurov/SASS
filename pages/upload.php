
<h1>Upload new picture</h1>
<form action="backend/upload-image.php" method="post" enctype="multipart/form-data" onsubmit="return Validate(this);">
	<div class="panel panel-info">
	<div class="panel-heading">Only pictures are allowed!</div>
	<div class="panel-body">
		<div class="form-group">
	    	<input type="file" name="fileToUpload" id="fileToUpload">
	  	</div>
	  	<button type="submit" value="Upload Image" name="submit" class="btn btn-primary">Upload picture</button>
	  	</div>
  	</div>
</form>


