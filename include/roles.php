<?php

use App\Role;

global $adminRole, $doyRole, $epitropiRole, $epoptisRole, $epistatisRole, $userRole;

$adminRole = Role::where('name', 'admin')->first();
$doyRole = Role::where('name', 'doy')->first();
$epitropiRole = Role::where('name', 'epitropi')->first();
$epoptisRole = Role::where('name', 'epoptis')->first();
$epistatisRole = Role::where('name', 'epistatis')->first();
$userRole = Role::where('name', 'user')->first();

