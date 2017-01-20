<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 9/17/2014
 * Time: 10:26 AM
 */

class Password_Generator{
    function generate_password($length=8){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }
}