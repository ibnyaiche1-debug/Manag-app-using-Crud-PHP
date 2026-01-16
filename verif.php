<?php
    require "conn.php";

    if( isset($_POST['loginEmail']) and isset($_POST['loginPassword'])){
        $pass=$_POST['loginPassword'];
        $email=$_POST['loginEmail'];

        $stmV=$connection->prepare("select * from users where email=:email");
        $stmV->execute([":email"=>$email]);
        if($stmV->rowCount()>0){
            $stmV->setFetchMode(PDO::FETCH_ASSOC);
            $ligne = $stmV->fetch();
            if(password_verify($pass,$ligne["password_hash"])==true){
                session_start();
                $_SESSION['user_id']=$ligne["id"];
                header("location:accueil.php");
            }else{
                header("location:login.php?msg=Passwod incorrect");
            }

        }else{
        header("location:login.php?msg=Email incorrect");
            }
               
    }
?>