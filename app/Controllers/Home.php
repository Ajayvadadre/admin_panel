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
    public function displayCreateCampaign()
    {
        $data['page'] = '/campaigns/createcampaigns_page';
        echo view('/inc/template', $data);
    }
    public function createCampaign()
    {
        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');
        $client = $this->request->getVar('client');
        $supervisor = $this->request->getVar('supervisor');

        $checkCampaign = $this->campaign->createCampaign($name, $description, $client, $supervisor);

        // if ($checkCampaign) {
        //     session()->setFlashData("sameCampaignError", "Campaign Name already exists");
        //     return   redirect()->to('/displayCreateCampaign');
        // } else {
        //     return redirect()->to('/Campaigns');
        // }
        // if ($checkCampaign) {
        //     session()->setFlashData("sameCampaignError", "Campaign Name already exists");
        //     return   redirect()->to('/displayCreateCampaign');
        // } else {
        //     $this->campaign->save([
        //         "name" => $name,
        //         "description" => $description,
        //         "client" => $client,
        //         "supervisor" => $supervisor
        //     ]);
        // }

    }
    public function displayProcess($id)
    {

        $data['data'] =  ['all_process' => null];
        $data['page'] = '/process/process_page';
        echo view('/inc/template', $data);
    }
    public function displayCreateProcess($id)
    {
        $data['page'] = '/process/createprocess_page';
        echo view('/inc/template', $data);
    }
    public function createProcess()
    {
        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');
        $client = $this->request->getVar('client');
        $supervisor = $this->request->getVar('supervisor');

        $this->campaign->createProcess($name, $description, $client, $supervisor);

        return redirect()->to('/Campaigns');
    }
    public function showUsers()
    {
        $state = $this->request->getGet('state');
        $userName = $this->request->getGet('userName');
        $all_users_dropDown = $this->user->paginate();
        $pagerData = $this->user->pager;
        $accessLevel = $this->accessLevel->getAccessLevels();
        $all_users = $this->user->showUsers($state, $userName);
        $data['pager'] = ['pager' => $pagerData];
        $data['page'] = 'users/users_page';
        $data['data'] =  ['all_users' => $all_users, 'accesslevel' => $accessLevel,  "all_users_dropDown" => $all_users_dropDown];
        echo view('/inc/template', $data);
    }
    public function showCampagins()
    {
        $Name = $this->request->getGet('Name');
        $Client = $this->request->getGet('Client');
        $Supervisor = $this->request->getGet('Supervisor');
        $query = $this->campaign;

        if ($Name) {
            $query->like("Accesslevel", $Name);
        }
        if ($Client) {
            $query->like("Username", "$Supervisor%", 'after');
        }

        $all_campaigns = $this->campaign->paginate(4);
        $pagerData = $this->campaign->pager;
        $data['pager'] = ['pager' => $pagerData];
        $data['page'] = '/campaigns/campaigns_page';
        $data['data'] =  ['all_campaigns' => $all_campaigns];
        echo view('/inc/template', $data);
    }
    public function displayCreateUsers()
    {
        $data['page'] = 'users/createusers_page';
        echo view('/inc/template', $data);
    }
    public function createUser()
    {
        $Firstname = $this->request->getVar('Firstname');
        $Lastname = $this->request->getVar('Lastname');
        $Username = $this->request->getVar('Username');
        $Password = $this->request->getVar('Password');
        $Accesslevel = $this->request->getVar('Accesslevel');

        $checkUser = $this->user->where('Username', $Username)->first();

        if ($checkUser) {
            session()->setFlashdata('sameUsername', 'Username already exists');
            return redirect()->to('/displayCreateUsers');
        } else {
            $this->user->save([
                "Firstname" => $Firstname,
                "Lastname" => $Lastname,
                "Username" => $Username,
                "Password" => $Password,
                "Accesslevel" => $Accesslevel
            ]);
        }

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
        if ($data) {
            return redirect()->to('/Users');
        }
    }
    public function displayUpdateUser($id)
    {
        $userData = $this->user->displayUpdateUser($id);
        $data['page'] = 'users/createusers_page';
        $data['data'] =  ['userData' => $userData];
        echo view('/inc/template', $data);
    }
    public function displayUpdateCampaign($id)
    {
        $userData = $this->campaign->find($id);
        $data['page'] = 'campaigns/updatecampaign_page';
        $data['data'] =  ['userData' => $userData];
        echo view('/inc/template', $data);
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
        if ($data) {
            return redirect()->to('/Campaigns');
        }
    }
}
