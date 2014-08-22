<?php
class login{
    private $email;
    private $password;



function __construct($e, $p){
        $this->email = $e;
        $this->password= $p;
    }

 function getemail(){
        return $this->email;
    }
    
    function getpassword(){
        return $this->password;
    }

}
?>
