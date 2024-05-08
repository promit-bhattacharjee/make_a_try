<?php
if(!session_start())
{
    session_start();
}
class LoginChecker{
    function  __construct(){
        $this->loginChecker();
    }
    protected function loginChecker()
    {
        if(isset($_SESSION['user_id']) && isset($_SESSION['user_mobile']) ){
            return true;
        }
        else{
            echo "<script>window.alert('Login First')</script>;";
            echo '<script>window.location.href = "../pages/home.php";</script>';
        }
    }

}
new LoginChecker();
?>
