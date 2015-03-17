<?php
	if(isset($_GET['saved'])) {
		echo '<div class="alert alert-success saved"><span class="glyphicon glyphicon-ok"></span><strong> Well done.</strong> You successfully uploaded a picture.</div>';
	}
	if(isset($_GET['error'])) {
		echo '<div class="alert alert-danger saved"><span class="glyphicon glyphicon-ok"></span><strong> Oh snap!.</strong> Something went wrong! ' . urldecode($_GET['error']) . '</div>';
	}
?>
<h1>My pictures</h1>
<div class="col-md-8">
  	<table class="table table-hover">
  		<tr>
  			<th>Id</th>
  			<th>Picture</th>
  			<th>View comments</th>
  			<th>New comment</th>
  			<th>Share picture</th>
  		</tr>
      <?php
      	
      	// Get pictures from database based on username stored in the session.
      	
      	include_once('backend/Qry.php');
		
		$myPictures = Qry::q('SELECT id, picture FROM pictures WHERE owner_id=' . $_SESSION["login"]['id']);
      	
		/*
		$myPictures = [ 
			['id' => 1, 'url' => 'GwyBzG3.jpg'], 
			['id' => 3, 'url' => 'background.jpg'] 
		];*/
		
		$path = 'backend/uploads/';
		$counter = 1;
		foreach ($myPictures as $value) {
			echo "<tr>";
			echo "<td>".$value['id']."</td>";
			echo '<td><a href="'.$path . $value['picture'].'" data-lightbox="image-1">'.$value['picture'].'</a></td>';
			echo '<td><a class="btn btn-default btn-xs" href="#" role="button">View</a></td>';
			echo '<td><a class="btn btn-default btn-xs" href="#" role="button">New</a></td>';
			echo '<td><a class="btn btn-primary btn-xs share-'.$counter++.'" href="#" role="button">Share</a></td>';
			echo "</tr>";
		}
      ?>
	</table>
	
	
	<style>
		
		.popup {
		    margin-left: auto;
		    margin-right: auto;
		    width: 500px;
		    height: 300px;
		    padding: 20px;
			-webkit-box-shadow: 0px 5px 24px 3px rgba(0,0,0,0.78);
			-moz-box-shadow: 0px 5px 24px 3px rgba(0,0,0,0.78);
			box-shadow: 0px 5px 24px 3px rgba(0,0,0,0.78);
		    border-radius: 7px;
			border: 1px solid;
			background: #f1f1f1;
		    margin-top: 160px;
		    background-color: white;
		    
		    position:absolute;
		    z-index:1000;
		    top: -200px;
		    left: 130px;
			}

	</style>
	
	
		<div class="popup" style="display: none;">
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title"><h2 style="text-align: center;"><span class="glyphicon glyphicon-share"></span> Share picture</h2></h3>
			  </div>
			  <div class="panel-body">
			    <p>
			    	Who do you want to share this image with?
		    	</p>
		    	<form id="data-view" class="form-horizontal" action="#" method="get">
					<div class="form-group col-md-12">
						<div class="col-md-6">
							<select class="form-control" name="share">
								<?php 
								
									$share = Qry::q('SELECT id, email FROM users');
									foreach ($share as $value) {
										if($value['email'] != $_SESSION['login']['email']) {
											echo '<option value="'.$value['id'].'">'.$value['email'].'</option>';
										}
									}
								
								?>
						
							</select>
						</div>
						<div class="form-group">
							<button id="data-view-button" type="submit" name="submit" value="share" class="btn btn-primary btn-sm">Share</button>
						</div>
					</div>
				</form>

			  </div>
			</div>
		</div>
	

	<script>
		$(function(){
			click = true;
		    $(".share-1").click(function(){
		          //$('.popup').toggle('slow');
		          if(click) {
		          	$(".popup").stop().fadeIn(500);
		          	click = false;
		          } else {
		          	$(".popup").fadeOut(500);
		          	click = true;
		          }
		          
		    });
		    
		});
	</script>
</div>
  </div>
  <div class="row">
	<h1>Pictures shared with me</h1>
	<div class="col-md-8">
	  	<table class="table table-hover">
	  		<tr>
	  			<th>Id</th>
	  			<th>Picture</th>
	  			<th>Picture owner</th>
	  			<th>View comments</th>
	  			<th>New comment</th>
	  		</tr>
			
	      <?php
	      	
	      	$othersPictures = Qry::q('SELECT p.id, p.picture, u.email
									FROM pictures p 
									INNER JOIN picture_shared ps
										ON p.id = ps.picture_id
									INNER JOIN users u
										ON p.owner_id = u.id
									WHERE ps.shared_with_id=' . $_SESSION["login"]['id']);
	      	
	      	// Get pictures from database based on username stored in the session.
			//$othersPictures = [ ['id' => 2, 'url' => 'a9LYOg0_700b.jpg', 'owner' => 'dimi@itu.dk'] ];
			
			$path = 'backend/uploads/';
			foreach ($othersPictures as $value) {
				echo "<tr>";
				echo "<td>".$value['id']."</td>";
				echo '<td><a href="'.$path . $value['picture'].'" data-lightbox="image-1">'.$value['picture'].'</a></td>';
				echo '<td>'.$value['email'].'</td>';
				echo '<td><a class="btn btn-default btn-xs" href="#" role="button">View</a></td>';
				echo '<td><a class="btn btn-default btn-xs" href="#" role="button">New</a></td>';
				echo "</tr>";
			}
			      
	      ?>
		</table>
	</div>