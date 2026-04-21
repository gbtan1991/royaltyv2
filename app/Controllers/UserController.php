<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function index()
    {
        // This calls the All() method in your BaseModel!
        $users = User::All();

        // For testing, let's just return the data
        return $users;
    }
}