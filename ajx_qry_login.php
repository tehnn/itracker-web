<?php
    session_start();
    $user=$_POST['user'];
    $pass=$_POST['pass'];
    
    require 'condb.php';
    $sql= "select user,pass from account
        where user='$user' and pass='$pass'";
    
    $res=mysql_query($sql) or die (mysql_error());
  
    
    $num = mysql_num_rows($res);
       
    
    if($num > 0){
        echo 'ok';
        $_SESSION['user']=$user;
        
    }else{
        echo 'no';
    }


?>
