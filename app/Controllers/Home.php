<?php

namespace App\Controllers;

use App\Models\CampaginModel;
use App\Models\UserModel;
use App\Models\AccessLevel;

class Home extends BaseController
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
    public function showCampagins()
    {
        $all_campaigns = $this->campaign->findAll();
        echo view('/inc/header');
        echo view('/campaigns/campaigns_page', ['all_campaigns' => $all_campaigns]);
        echo view('/inc/footer');
    }
    public function displayCreateCampaign()
    {
        echo view('/inc/header');
        echo view('/campaigns/createcampaigns_page');
        echo view('/inc/footer');
    }
    public function createCampaign()
    {
        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');
        $client = $this->request->getVar('client');
        $supervisor = $this->request->getVar('supervisor');

        $this->campaign->save([
            "name" => $name,
            "description" => $description,
            "client" => $client,
            "supervisor" => $supervisor
        ]);

        return redirect()->to('/Campaigns');
    }
    public function displayProcess($id)
    {

        // $data['page'] = 

        echo view('/inc/header');
        echo view('/process/process_page', ['all_process' => null]);
        echo view('/inc/footer');
    }
    public function displayCreateProcess($id)
    {



        echo view('/inc/header');
        echo view('/process/createprocess_page');
        echo view('/inc/footer');
    }
    public function createProcess()
    {
        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');
        $client = $this->request->getVar('client');
        $supervisor = $this->request->getVar('supervisor');

        $this->campaign->save([
            "name" => $name,
            "description" => $description,
            "client" => $client,
            "supervisor" => $supervisor
        ]);

        return redirect()->to('/Campaigns');
    }
    public function showUsers()
    {
        $db = \Config\Database::connect();
        $query = 'select *, ( select roles from accesslevel where accesslevel.id = users.Accesslevel ) as accessname from users;';
        $resultTable = $db->query($query);
        $all_users = $this->user->findAll();
        $accessLevels = $this->accessLevel->getAccessLevels();
        echo view('/inc/header');
        echo view('users/users_page', ['all_users' => $resultTable->getResult()]);
        echo view('/inc/footer');
    }
    public function displayCreateUsers()
    {
        echo view('/inc/header');
        echo view('users/createusers_page');
        echo view('/inc/footer');
    }
    public function createUser()
    {
        $Firstname = $this->request->getVar('Firstname');
        $Lastname = $this->request->getVar('Lastname');
        $Username = $this->request->getVar('Username');
        $Password = $this->request->getVar('Password');
        $Accesslevel = $this->request->getVar('Accesslevel');

        $this->user->save([
            "Firstname" => $Firstname,
            "Lastname" => $Lastname,
            "Username" => $Username,
            "Password" => $Password,
            "Accesslevel" => $Accesslevel
        ]);

        return redirect()->to('/Users');
    }
    public function DeleteUser($id)
    {
        $this->user->DeleteUser($id);
        return redirect()->to('/Users');
    }
    public function UpdateUser($id) 
    {
        $Firstname = $this->request->getVar('Firstname');
        $Lastname = $this->request->getVar('Lastname');
        $Username = $this->request->getVar('Username');
        $Password = $this->request->getVar('Password');
        $Accesslevel = $this->request->getVar('Accesslevel');
        $data = [
            "Firstname" => $Firstname,
            "Lastname" => $Lastname,
            "Username" => $Username,
            "Password" => $Password,
            "Accesslevel" => $Accesslevel
        ];
        $this->user->UpdateUser($id, $data);
        if($data){
            return redirect()->to('/Users');
        }
    }
    public function displayUpdateUser($id)
    {

        $userData = $this->user->find($id);

        echo view('/inc/header');
        echo view('users/updateusers_page', ['userData' => $userData]);
        echo view('/inc/footer');
    }
    public function displayUpdateCampaign($id)  
    {

        $userData = $this->campaign->find($id);

        echo view('/inc/header');
        echo view('campaigns/updatecampaign_page', ['userData' => $userData]);
        echo view('/inc/footer');
    }
    public function deleteCampaign($id)
    {
        
        $this->campaign->DeleteCampaign($id);
        return redirect()->to('/Campaigns');
    }
    public function UpdateCampaign($id) 
    {
        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');
        $client = $this->request->getVar('client');
        $supervisor = $this->request->getVar('supervisor');
        $data = [
            "name" => $name,
            "description" => $description,
            "client" => $client,
            "supervisor" => $supervisor
        ];
        $this->campaign->UpdateCampaign($id, $data);
        if($data){
            return redirect()->to('/Campaigns');
        }
    }
}
