<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
    require "conn.php";

    if(isset($_POST['fullName']) and isset($_POST['email']) and isset($_POST['password'])){
        $nom=$_POST['fullName'];
        $email=$_POST['email'];
        $password=password_hash($_POST['password'],PASSWORD_DEFAULT);

        $stmV=$connection->prepare("select * from users where email=:email");
        $stmV->execute([":email"=>$email]);
        if($stmV->rowCount()>0){
            header("location:register.php?msg=Email deja existe");
        }else{
        $stm=$connection->prepare("insert into users(full_name,email,password_hash) values(:nom,:email,:pass)");
            if($stm->execute([":nom"=>$nom,":email"=>$email,":pass"=>$password])==true){
                header("location:login.php");
                }
            }
               
    }
?>