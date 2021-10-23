<?php require_once "autoload.php" ?>
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
		 $pass=$_POST['pass'];
		 $cpass=$_POST['cpass'];
		 $gender=NULL;
		 if(isset($_POST['gender'])){
			 $gender=$_POST['gender'];
		 }
         $hash_pass=gethash($pass);
		 if(empty($name) || empty($email) || empty($cell) || empty($username)||empty($pass) || empty($gender)){
			 $msg=validate('All fields are required','danger');
		 }else if (checkemail($email) == false) {
			$msg = validate('Invalid email address ','danger');
		} else if (ceilcheck($cell) == false) {
			$msg = validate('Invalid Cell number','danger');
		}else if(checkpass($pass,$cpass)==false){
			$msg=validate('Confirm password does not match','warning');
		}else if(datacheck('users','email',$email)==false){
			$msg=validate('Email already exist','warning');
		}else if(datacheck('users','cell',$cell)==false){
			$msg=validate('Cell already exist','warning');
		}else if(datacheck('users','username',$username)==false){
			$msg=validate('Username already exist','warning');
		}
		else{
			connect()->query("INSERT INTO users(name,email,cell,username,password,gender)VALUES('$name','$email','$cell','$username','$hash_pass','$gender')");
			$msg=validate('Your registration is successful','success');
		}
	 }




    ?>
	

	<div class="wrap shadow">
		<div class="card">
			<div class="card-body">
				<h2>Create An Account</h2>
				<?php
                      if(isset($msg)){
						  echo $msg;
					  }
				?>
				<form action="" method="POST" entype="multipart/form-data">
					<div class="form-group">
						<label for="">Name</label>
						<input name="name" class="form-control" value="<?php old('name'); ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input name="email"class="form-control" value="<?php old('email'); ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Cell</label>
						<input name="cell" class="form-control" value="<?php old('cell'); ?>"type="text">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input name="username" class="form-control" value="<?php old('username'); ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Gender</label><br>
						<input name="gender"id="Male" value="Male" type="radio"><label for="Male">Male</label>
						<input name="gender"id="Female" value="Female"type="radio"><label for="Female">Female</label>
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input name="pass" class="form-control" type="password">
					</div>
					<div class="form-group">
						<label for="">Confirm Password</label>
						<input name="cpass" class="form-control" type="password">
					</div>
					<div class="form-group">
						<input class="btn btn-primary" type="submit"name="add" value="Sign Up">
					</div><hr>
					<a href="index.php">Login Now!</a>
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