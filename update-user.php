<?php
    session_start();
    require "db/db.php";
    $db = new db();
    $id = $_POST['id'] ;
    if (isset($_POST['update']))
    {
        $name = $_POST['name'];
        $pass = sha1($_POST['password']);
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $birthdate = $_POST['birthdate'];
        $address = $_POST['address'];

        $update = $db->updateUser($id, $name, $pass, $phone, $gender, $birthdate ,$address);
        if ($update = null)
        {
            $_SESSION['updatefaile'] = "Update Failed!";
             header('location:profile.php');
        }
        else
        {
           $_SESSION['updatesuccess'] = "Update successful!";
           header('location:profile.php');
        }
    }
?>