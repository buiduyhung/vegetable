<?php

if (!function_exists('convertPrice')) {
    function convertPrice($amount, $currency = 'đ')
    {
        return number_format($amount) . $currency;
    }
}


function isRole($data, $moduleArr, $role='view'){
    if(!empty($data->$moduleArr)){
        $roleArr = $data->$moduleArr;

        if(!empty($roleArr) && in_array($role, $roleArr)){
            return true;
        }
    }

    return false;
}