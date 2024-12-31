<?php

namespace App\Controllers;

use App\Models\CampaginModel;
use App\Models\UserModel;
use App\Models\AccessLevel;

class Chatcontroller extends BaseController
{
    public $campaign;
    public $user;
    public $accessLevel;

    public function __construct()
    {
        $this->campaign = new CampaginModel();
        $this->user = new UserModel();
        $this->accessLevel = new AccessLevel();
    }
    public function index(): string
    {

        return view('/auth/login_page');
    }
    public function showDashboard()
    {
        echo view('/inc/header');
        echo view('/home');
        echo view('/inc/footer');
    }

    public function getShowChat()   
    {   $all_user = $this->user->showUsers(null,null);
        echo view('/chat/Chat_page',["all_user"=>$all_user]);
    }
}
