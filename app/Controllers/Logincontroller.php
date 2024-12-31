<?php

namespace App\Controllers;

use App\Models\CampaginModel;
use App\Models\UserModel;
use App\Models\UserCredsModel;

class Logincontroller extends BaseController
{
    private $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        return  view('login_page');
    }

    public function authenticate()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $userModel = new UserModel();
        $user = $userModel->where('Username', $username)->first();
        if ($user) {
            $session = session();
            $session->set('username', $username);
            return redirect()->to(base_url('/Campaigns'));
        } else {
            session()->setFlashdata("usernameError", "User not found");
            return redirect()->to(base_url('/'));
        }
    }
    public function logOut()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
