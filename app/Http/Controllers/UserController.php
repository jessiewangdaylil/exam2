<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function show($id = 1)
    {
        return 'User ' . $id;
    }
}
