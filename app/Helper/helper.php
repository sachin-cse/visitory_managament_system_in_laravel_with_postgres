<?php
if(!function_exists('getUserRole')){

    function getUserRole(){
        $userRole = [
            '1'=>'Super Admin',
            '2' => 'Teacher',
            '3' => 'Student',
            '4'=>'Parent'
        ];
    
        dd($userRole);
    }
}
?>