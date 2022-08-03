<?php

namespace App\Repositories\Interfaces;


interface AuthRepository{

    public function checkLogin($request ,$table , $guardName , $routRedirect);

    public function storeDataRegister($request, $ModelName, $route_verify, $user_client_id,$routredirect = NULL);

    public function storeResetLink($request, $table , $RoutePasswordReset = NULL);

    public function confirmPassword($request, $table ,$ModelName , $routredirect = NULL);

    public function verify($request , $relation , $route);

    public function logout($request , $guardName , $routRedirect);
}


