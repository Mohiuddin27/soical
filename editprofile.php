<?php require_once "autoload.php";

if(userlogincheck() == false){
    header('location:index.php');
}
else{
    $login_data=loginuserdata('users',$_SESSION['id']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	<?php

     if(isset($_POST['add'])){
		 $name=$_POST['name'];
		 $email=$_POST['email'];
		 $cell=$_POST['cell'];
		 $username=$_POST['username'];
		 $age=$_POST['age'];
         $edu=$_POST['edu'];
		 $updated= date('Y-d-m  h:m:s');
		 $gender=NULL;
		 if(isset($_POST['gender'])){
			 $gender=$_POST['gender'];
		 }
       
		 if(empty($name) || empty($email) || empty($cell) || empty($username)|| empty($gender)){
			 $msg=validate('All fields are required','danger');
		 }
		else{
			connect()->query("UPDATE users SET name='{$name}',email='{$email}',cell='{$cell}',username='{$username}',age='{$age}',edu='{$edu}',gender='{$gender}', updated_at='{$updated}'  WHERE id='$login_data->id' ");
			$msg=validate('Data update is successful','success');
			setmsg('success','update data successful');
			header("location:editprofile.php");
		}
	 }

    


    ?>

		<nav  class="profile-menu shadow-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-2">
                   <ul class="nav nav-tab d-flex justify-content-center">
                       <li class="nav-item"><a class="nav-link"href="profile.php">My Profile</a></li>
                       <li  class="nav-item"><a class="nav-link"href="friend.php">Friends</a></li>
                       <li  class="nav-item"><a class="nav-link"href="editprofile.php">Edit Profile</a></li>
                       <li  class="nav-item"><a class="nav-link"href="photo.php">Upload Photo</a></li>
                       <li  class="nav-item"> <a class="nav-link"href="password.php">Password Change</a></li>
                       <li  class="nav-item"> <a class="nav-link"href="logout.php">Log Out</a></li>
                      
                   </ul>
                </div>
            </div>
        </div>
     </nav> 

    
	<div class="wrap shadow">
		<div class="card">
			<div class="card-body">
				<h2>Update Profile</h2>
				<?php
                      	   getmsg('success'); 
				?>
				<form action="" method="POST" entype="multipart/form-data">
					<div class="form-group">
						<label for="">Name</label>
						<input name="name" class="form-control" value="<?php echo $login_data->name; ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input name="email"class="form-control" value="<?php echo $login_data->email; ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Cell</label>
						<input name="cell" class="form-control" value="<?php echo $login_data->cell; ?>"type="text">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input name="username" class="form-control" value="<?php echo $login_data->username; ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Gender</label><br>
						<input name="gender" <?php echo ($login_data->gender == 'Male') ? 'checked' : ''; ?> id="Male" value="Male" type="radio"><label for="Male">Male</label>
						<input name="gender" <?php echo ($login_data->gender == 'Female') ? 'checked' : ''; ?> id="Female" value="Female"type="radio"><label for="Female">Female</label>
					</div>
					<div class="form-group">
						<label for="">Age</label>
						<input name="age" class="form-control" value="<?php echo $login_data->age; ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Education</label>
						<input name="edu" class="form-control" value="<?php echo $login_data->edu; ?>" type="text">
					</div>
					<div class="form-group">
						<input class="btn btn-primary" type="submit"name="add" value="Update">
					</div><hr>
					<a href="profile.php">Sent to Profile</a>
				</form>
			</div>
		</div>
	</div>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>