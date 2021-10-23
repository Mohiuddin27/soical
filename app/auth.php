<?php

function authcheck($table,$col,$val){
    $login_data=connect()->query("SELECT * FROM {$table} WHERE {$col}='$val'");
    if($login_data->num_rows == 1){
        return $login_data->fetch_object();
    }else{
        return false;
    }
}
function passcheck($user_pass,$db_pass){
    $data=password_verify($user_pass,$db_pass);
    if($data==true){
        return true;
    }else{
        return false;
    }
}
function userlogincheck(){
    if(isset($_SESSION['id'])){
        return true;
    }else{
        return false;
    }
}
function loginuserdata($table,$id){
   $data=connect()->query("SELECT * from {$table} WHERE id='$id'");
   return $data->fetch_object();
}