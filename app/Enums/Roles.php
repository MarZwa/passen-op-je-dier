<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'Admin';
    case Owner = 'Owner';
    case Sitter = 'Sitter';
}