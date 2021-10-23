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
     <div class="container">
         <div class="row">
         <?php 
                           $data=connect()->query("SELECT * FROM users");
                           while($in=$data->fetch_object()):


                         ?>
                         <?php if($in->id != $_SESSION['id']) :?>             
                <div class="col-md-3">
                 <div class="card">
                     <div class="card-body">
                        
                        <div class="friends text-center">
                         <img style="width:150px;height:150px;object-fit:cover;"src="media/users/<?php echo $in->photo; ?>" alt="">
                         <h3><?php echo $in->name; ?></h3>
                         <a class="btn btn-primary" href="profile.php?user_id=<?php echo $in->id; ?>">View Profile</a>
                       </div>
                    
                     </div>
                 </div>
             </div>
             <?php endif; ?>
             <?php endwhile; ?>
         </div>
     </div>




	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>