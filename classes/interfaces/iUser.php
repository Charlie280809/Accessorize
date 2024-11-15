<?php
    namespace App\Accessorize\Interfaces;
    interface iUser{
        // public function login();
        public function canLogin($p_email, $p_password);
        // public function logout();
    }
?>