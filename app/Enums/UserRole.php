<?php

namespace App\Enums;

enum UserRole: string
{
    case CHILD = 'child';
    case PARENT = 'parent';
}
