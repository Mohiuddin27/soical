<?php

function validate($txt,$type){
    return "<p class=\"alert alert-{$type}\">$txt<button class=\"close\" data-dismiss=\"alert\">&times;</button></p>";
}
function checkemail($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        return TRUE;
    }else{
        return FALSE;
    }
}

function agecheck($age){
    if($age>=18 && $age<=30){
        return TRUE;
    }
    else{
        return FALSE;
    }
}
function ceilcheck($cell){
     $length=strlen($cell);
     if(substr($cell,0,2)=='01' && $length == 11){
         return TRUE;
     }
     else if(substr($cell,0,4) == '8801' && $length == 13){
         return TRUE;
     }
     else if(substr($cell,0,5) == '+8801' && $length == 14){
         return TRUE;
     }
     else{
         return FALSE;
     }
}
function instrmail(string $email, array $mails){
    $mail_arr=explode('@',$email);
    $last=end($mail_arr);
    if(in_array($last,$mails)){
        return TRUE;
    }
    else{
        return FALSE;
    }
}
function old($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }else{
        echo "";
    }
}
function formclear(){
    $_POST="";
}

function move($file, $path = '/')
{

    $file_name = time() . '_' . rand() . '_' . $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];

    move_uploaded_file($file_tmp, $path . $file_name);

    return $file_name;
}
function find($table,$id){
    $sql="SELECT * FROM {$table} where id='$id'";
    $data=connect()->query($sql);
    return $data->fetch_object();
}
function slug($name){
    $nlower=strtolower($name);
    return str_replace(' ','_',$nlower);
}
function all($table,$order='ASC'){
    return connect()->query("SELECT * FROM {$table} order by id {$order}");
}
function checkpass($pass,$cpass){
    if($pass === $cpass){
        return true;
    }else{
        return false;
    }
}
function gethash($pass){
    return password_hash($pass,PASSWORD_DEFAULT);
}

function datacheck($table,$col,$val){
    $data=connect()->query("SELECT {$col} FROM {$table} WHERE {$col}='$val'");
    if($data->num_rows > 0){
        return false;
    }else{
        return true;
    }
}