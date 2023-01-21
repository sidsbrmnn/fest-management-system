<?php 

// database Connection
$conn = mysqli_connect('hostname', 'username', 'password', 'database');
// check for connection error
if($conn->connect_error){
  die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error);    
}

if(isset($_POST['submit'])){

	$filename = $_FILES['image']['name'];
	
	// Select file type
	$imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	
	// valid file extensions
	$extensions_arr = array("jpg","jpeg","png","gif");
 
	// Check extension
	if( in_array($imageFileType,$extensions_arr) ){
 
	// Upload files and store in database
	if(move_uploaded_file($_FILES["image"]["tmp_name"],'upload/'.$filename)){
		// Image db insert sql
		$insert = "INSERT into image(file_name,uploaded_on,status) values('$filename',now(),1)";
		if(mysqli_query($conn, $insert)){
		  echo 'Data inserted successfully';
		}
		else{
		  echo 'Error: '.mysqli_error($conn);
		}
	}else{
		echo 'Error in uploading file - '.$_FILES['image']['name'].'<br/>';
	}
	}
} 
?>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<h1>Select Image to Upload</h1>
	<form method='post' action='#' enctype='multipart/form-data'>
	<div class="form-group">
	 <input type="file" name="image" id="file" multiple>
	</div> 
	<div class="form-group"> 
	 <input type='submit' name='submit' value='Upload' class="btn btn-primary">
	</div> 
	</form>
</div>	
</body>
</html>
