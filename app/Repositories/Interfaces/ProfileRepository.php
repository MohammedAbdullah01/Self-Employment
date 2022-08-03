<?php

namespace App\Repositories\Interfaces;


interface ProfileRepository
{
    public function getProfile($ModelName ,  $Slug , $Relation );

    public function updateProfile($ModelName , $guardName ,  $request , $Path_Folder_Avatar , $Forgin_Key);

    public function changePassword($request , $ModelName , $GuardName , $RedirectRoute);
}
