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
        if(isset($_SESSION['admin_id']) && isset($_SESSION['admin_link']) ){
            return true;
        }
        else{
            echo "<script>window.alert('Hey Admin Use Valid URL First')</script>;";
            echo '<script>window.location.href = "../pages/home.php";</script>';
        }
    }

}
new LoginChecker();
?>
