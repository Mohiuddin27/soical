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
     <section class="user-profile">
     
       <?php
           if(isset($_POST['cp'])){
               $old=$_POST['old'];
               $new=$_POST['new'];
               $cnew=$_POST['cnew'];
               $hash_pass=gethash($new);
               if(empty($old) || empty($new) || empty($cnew)){
                   $msg=validate("All fields are required",'danger');
               }
               else if($new != $cnew){
                   $msg=validate("Password confirmation faild",'danger');
               }
               else if(password_verify($old,$login_data->password)==false){
                   $msg=validate("Old password not match",'warning');
               }
               else{
                   connect()->query("UPDATE users SET password='$hash_pass' WHERE id='$login_data->id'");
                   session_destroy();
                   header('location:index.php');
               }
           }




       ?>
       
         <div class="card text-center">
             <div class="card-body">
               <form action="" method="POST">
                   <div class="form-group">
                       <input name="old" type="password" class="form-control" placeholder="Old password">
                   </div>
                   <div class="form-group">
                       <input name="new" type="password" class="form-control" placeholder="New password">
                   </div>
                   <div class="form-group">
                       <input name="cnew" type="password" class="form-control" placeholder="Confirm password">
                   </div>
                   <div class="form-group">
                       <input name="cp" type="submit" class="btn btn-primary" value="Change password">
                   </div>
              </form>
         </div>
       </div>
    </section>






	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>