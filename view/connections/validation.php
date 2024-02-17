<?php
class validationData{
function __construct(){

}
private function emailValidation(string $email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
}
}
?>