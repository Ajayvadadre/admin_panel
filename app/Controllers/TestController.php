<?php

namespace App\Controllers;

use App\Models\CampaginModel;
use App\Models\UserModel;
use App\Models\AccessLevel;

class testController extends BaseController
{
    // public $campaign;
    // public $user;
    // public $accessLevel;

    // public function __construct()
    // {
    //     $this->campaign = new CampaginModel();
    //     $this->user = new UserModel();
    //     $this->accessLevel = new AccessLevel();
    // }
    public function getIndex()
    {
        echo "Hello";    
    }
    public function getData(){
        echo "getData called";
    }
}