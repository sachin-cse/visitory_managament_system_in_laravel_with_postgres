<?php
if(!function_exists('getUserRole')){

    function getUserRole(){
        $userRole = [
            '1' => 'Teacher',
            '2' => 'Student',
            '3'=>'Parent'
        ];
    
        return $userRole;
    }
}
?>