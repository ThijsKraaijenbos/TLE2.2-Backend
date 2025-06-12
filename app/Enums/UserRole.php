<?php

namespace App\Enums;

enum UserRole: string
{
    case CHILD = 'child';
    case PARENT = 'parent';

    //Custom function that can be called to get a list of all available roles as a string
    public static function getRolesList(): string
    {
        $array = array_column(self::cases(), 'value');
        return implode(", ", $array);
    }


}
