<?php require_once "autoload.php"; 
if(userlogincheck() == true){
    header('location:profile.php');
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
	   if(isset($_POST['signup'])){
		    $login= $_POST['login'];
		    $pass= $_POST['password'];
		   if(empty($login) || empty($pass)){
			   $msg=validate('All fields are required','danger');
		   }else{
			   $login_user_data=authcheck('users','email',$login);
               if($login_user_data !== false){
				   if(passcheck($pass,$login_user_data->password)){
					   $_SESSION['id']=$login_user_data->id;
					   $_SESSION['name']=$login_user_data->name;
					   $_SESSION['email']=$login_user_data->email;
					   $_SESSION['username']=$login_user_data->username;
					   $_SESSION['cell']=$login_user_data->cell;
					   $_SESSION['gender']=$login_user_data->gender;
					   $_SESSION['photo']=$login_user_data->photo;
					   header('location:profile.php');
				   }else{
					   $msg=validate('Password is incorrect','warning');
				   }
			   }
			   else{
				   $msg=validate('Email is invalid','warning');
			   }
		   }
	   }
    ?>
	<div class="wrap shadow" method="POST">
		<div class="card">
			<div class="card-body">
				<h2>Log In</h2>
				<?php
                    if(isset($msg)){
						echo $msg;
					}
				?>
				<form action="" method="POST">
					<div class="form-group">
						<label for="">Login Info</label>
						<input name="login" class="form-control" type="text" value="<?php old('login') ?>"placeholder="Email or Cell or Username">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input name="password" class="form-control" type="password" placeholder="password">
					</div>
					
					<div class="form-group">
						<input name="signup"class="btn btn-primary text-center"" type="submit" value="Log In">
					</div>
				</form>
				<hr>
					<div>
                        <a href="reg.php">Please Do Register</a>
                    </div>
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