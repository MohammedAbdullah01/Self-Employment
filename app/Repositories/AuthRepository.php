<?php

namespace App\Repositories;


interface AuthRepository{

    function storeDataRegister($request , $ModelName,$route_verify,$user_client_id);
    function storeResetLink($request ,  $RoutePasswordReset);
    public function confirmPassword($request , $ModelName);
}


