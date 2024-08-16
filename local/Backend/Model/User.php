<?php

namespace Backend\Controller;

use Backend\Databases\Database;

class UserController {

    public function index() {

        
        return view('user.index');
    }
}