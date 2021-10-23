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
	<title><?php echo $login_data->name ?></title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	<?php 
         if(isset($_GET['user_id'])){
             $user_id=$_GET['user_id'];
             $data=connect()->query("SELECT * from users where id='$user_id'");
             $login_data=$data->fetch_object();
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
     <section class="user-profile">
     <?php  if(isset($login_data->photo)): ?>
             <img calss="shadow" src="media/users/<?php echo $login_data->photo; ?>" alt="">
        <?php  elseif($login_data->gender == 'Male'): ?>
             <img calss="shadow" src="assets/media/img/m.jpg" alt="">
        <?php  else : ?>
            <img calss="shadow"src="assets/media/img/female.png" alt="">
        <?php endif; ?> 
         <h3 class="text-center"><?php echo $login_data->name;?></h3>
         <div class="card">
             <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <td>Name</td>
                        <td><?php echo $login_data->name; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $login_data->email;?></td>
                    </tr>
                    <tr>
                        <td>Cell</td>
                        <td><?php echo $login_data->cell ?></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td><?php echo $login_data->gender;?></td>
                    </tr>
                    <?php if($login_data->age !=NULL ) :  ?>
                      <tr>
                         <td>Age</td>
                         <td><?php echo $login_data->age;?></td>
                      </tr>
                    <?php endif; ?>
                    <?php if($login_data->edu !=NULL) : ?>
                     <tr>
                         <td>Education</td>
                         <td><?php echo $login_data->edu;?></td>
                     </tr>
                    <?php endif; ?>
                    
                </table>
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