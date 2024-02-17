<?php
session_start();
session_start();
            if(isset($_SESSION['user'])){

            }
            else{
              header("Location: home.html");
                exit();
            }
include 'database.php';
    $checkImageUpdated = $_FILES['userImage'];
    if ($checkImageUpdated['name'] != null) {
        $userEmail = (string) $_SESSION['user'];
        $userName = $_POST['userName'];
        $userAdress = $_POST['userAdress'];
        $userGender = $_POST['userGender'];
        $userImage = $_FILES['userImage'];
        $imageCurrentPath = $userImage["tmp_name"];
        $imageTargetPath = "assets/userImage/" . $userEmail . $userImage['name'];
        $uploadImage = move_uploaded_file($imageCurrentPath, $imageTargetPath);
        include "database.php";
        $query = "SELECT * FROM `user` WHERE `email`='$userEmail'";
        $emailExist = mysqli_query($connect, $query);
        if (mysqli_num_rows($emailExist) > 0) {
            $query = "UPDATE `user` SET `name`='$userName',`adress`='$userAdress',`gender`='$userGender',`image`='$imageTargetPath' WHERE `email`='$userEmail'";
            mysqli_query($connect, $query);

        } else {
            echo "<script>window.alert('Email al ready Exist');location.href='login.html'</script>";
        }

    }
    else{
    $userEmail = (string) $_SESSION['user'];
    $userName = $_POST['userName'];
    $userAdress = $_POST['userAdress'];
    $userGender = $_POST['userGender'];
    include "database.php";
    $query = "SELECT * FROM `user` WHERE `email`='$userEmail'";
    $emailExist = mysqli_query($connect, $query);
    if (mysqli_num_rows($emailExist) > 0) {
        $query = "UPDATE `user` SET `name`='$userName',`adress`='$userAdress',`gender`='$userGender' WHERE `email`='$userEmail'";
        mysqli_query($connect, $query);

    } else {
        echo "<script>window.alert('Email al ready Exist');location.href='login.html'</script>";
    }
}

?>