<?php

namespace App\Shared;

class AuthCredentials
{
    public static function getCredentialsUser()
    {
        return auth('api')->user();
    }

    public static function getCredentialsUserId()
    {
        return auth('api')->user()->id;
    }

    public static function getCredentialsRole()
    {
        return auth('api')->user()->role_id;
    }

    public static function userIsSuperAdmin()
    {
        return auth('api')->user()->role_id == Constants::ROLE_SUPERADMIN;
    }

    public static function getCredentialsEmail()
    {
        return auth('api')->user()->email;
    }
}
