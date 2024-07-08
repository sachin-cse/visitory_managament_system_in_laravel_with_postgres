<?php
if(!function_exists('getUserRole')){

    function getUserRole(){
        $userRole = [
            '2' => 'Teacher',
            '3' => 'Student',
            '4'=>'Parents'
        ];
    
        return $userRole;
    }
}
?>