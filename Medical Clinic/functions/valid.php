<?php
    function checkEmpty($value){
        if(empty($value)){
            return false;
        }
        return true;
    }; 
        // not min 3 character 
    function checkLies($value,$min){
        // He does not count numbers as letters
        if(trim(strlen($value)) <= $min){
            return false;
        }
        return true;
    }
    function validEmail($email){
        // filter_var it's fun use valid email
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            return false;
        }
        return true;
    }
?>