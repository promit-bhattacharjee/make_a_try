<?php
session_start();
class LoginChecker{
    function  __construct(){
        $this->loginChecker();
    }
    protected function loginChecker()
    {
        if(isset($_SESSION['user_email']) && isset($_SESSION['user_id']) ){
            return true;
        }
        else{
            echo "<script>window.alert('Login First')</script>;";
            // header("location:/makeatry/home.php");
        }
    }

}
new LoginChecker();
?>