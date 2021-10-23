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
     <?php  if(isset($login_data->photo)): ?>
             <img calss="shadow" src="media/users/<?php echo $login_data->photo; ?>" alt="">
        <?php  elseif($login_data->gender == 'Male'): ?>
             <img calss="shadow" src="assets/media/img/m.jpg" alt="">
        <?php  else : ?>
            <img calss="shadow"src="assets/media/img/female.png" alt="">
        <?php endif; ?> 
        <br>
        <br>
        <br>
        <?php 
          if(isset($_POST['upload'])){
              $user_id=$_SESSION['id'];
             
              if(empty($_FILES['photo']['name'])){
                  setmsg('warning','Plz select a photo');
                  header('location:photo.php');
                  
              } else {
                $file=move($_FILES['photo'],'media/users/');
                update("UPDATE users SET photo='$file' WHERE id='$user_id'");
                setmsg('success','Profile Photo uploaded');
                header('location:photo.php');
            }
           
          }
          getmsg('warning');
          getmsg('success');

          
        ?>
         <div class="card shadow">
             <div class="card-body">
               <form action="" method="POST" enctype="multipart/form-data">
                   <input type="file" name="photo">
                   <input type="submit" name="upload" value="upload">
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