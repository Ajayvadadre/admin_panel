<?php

namespace App\Controllers;

use App\Models\CampaginModel;
use App\Models\UserModel;
use App\Models\AccessLevel;

class Home extends BaseController
{
    public $campaign;
    public $user;
    public $pagers;
    public $accessLevel;

    public function __construct()
    {
        helper(['url']);
        $this->pagers = \Config\Services::pager();


        $this->campaign = new CampaginModel();
        $this->user = new UserModel();
        $this->accessLevel = new AccessLevel();
    }
    public function index(): string
    {

        return view('/auth/login_page');
    }

    public function displayCreateCampaign()
    {
        $data['page'] = '/campaigns/createcampaigns_page';
        echo view('/inc/template', $data);
    }

    public function showSqlData()
    {
        $page = $this->request->getVar('page') ? (int) $this->request->getVar('page') : 1;
        $perPage = 10;
        //curl request-----
        $ch = curl_init();
        $url = 'http://localhost:3000/mySql/summerisedata';
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = json_decode(curl_exec($ch), true);
        $total = count($response);
        // pagination logic
        $start = ($page - 1) * $perPage;
        $end = $start + $perPage;
        $paginatedData = array_slice($response, $start, $perPage);
        //sending data------
        $data['page'] = $page;
        $data['data'] = $paginatedData;
        $data['pager'] = $this->pagers->makeLinks($page, $perPage, $total);
        // var_dump($data['data']);
        echo view('inc/header');
        echo view('home', $data);
        echo view('inc/footer');
    }
    public function showMongoData()
    {
        $page = $this->request->getVar('page') ? (int) $this->request->getVar('page') : 1;
        $perPage = 10;
        //curl request-----
        $ch = curl_init();
        $url = 'http://localhost:3001/mongo/summarydata';
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = json_decode(curl_exec($ch), true);
        $total = count($response);
        //sending data------
        $data['page'] = $page;
        $data['data'] = array_slice($response, ($page - 1) * $perPage, $perPage);
        $data['pager'] = $this->pagers->makeLinks($page, $perPage, $total);
        // var_dump($data['data']);
        echo view('inc/header');
        echo view('mongodata', $data);
        echo view('inc/footer');
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

        $data['data'] = ['all_process' => null];
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
        $data['data'] = ['all_users' => $all_users, 'accesslevel' => $accessLevel, "all_users_dropDown" => $all_users_dropDown];
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
        $data['data'] = ['all_campaigns' => $all_campaigns];
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
        $data['data'] = ['userData' => $userData];
        echo view('/inc/template', $data);
    }
    public function displayUpdateCampaign($id)
    {
        $userData = $this->campaign->find($id);
        $data['page'] = 'campaigns/updatecampaign_page';
        $data['data'] = ['userData' => $userData];
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
    public function exportData()
    {
        $filename = 'users_data' . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        // get data 
        $ch = curl_init();
        $url = 'http://localhost:3000/mySql/summerisedata';
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = json_decode(curl_exec($ch), true);
        $file = fopen('php://output', 'w');
        $header = ["hours", "call count", "Total duration", "Total hold", "Total Mute", "total Ringing", "Total transfer", "Total onCall", "Total conferenace"];
        fputcsv($file, $header);
        foreach ($response as $key => $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        exit;
    }

    
    public function exportUserSummaryData($id)
    {
        $filename = 'users_data' . '.csv';
        $id = $this->request->
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        // get data 
        $ch = curl_init();
        $url =  $id === "mysql" ? 'http://localhost:3000/mySql/summerisedata' : ($id === "mongo" ? 'http://localhost:3001/mongo/summarydata' : ($id === "elastic" ? "localhost:3002/elastic/summary" : ''));
        // $url = 'http://localhost:3000/mySql/summerisedata';
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = json_decode(curl_exec($ch), true);
        $file = fopen('php://output', 'w');
        $header = ["datetime",    "type",    "disposetype",    "disposename",    "duration",    "agentname",    "campaignName",    "processName",    "leadset",    "referenceUuid",    "customerUuid",    "hold",    "mute",    "ringing",    "transfer",    "conference",    "oncall",    "disposetime"];
        fputcsv($file, $header);
        foreach ($response as $key => $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        exit;
    }
    public function logger_report($id)
    {
        $page = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;
        $perPage = 10;
        $data['id'] = $id;
        // Number of records per page 
        $ch = curl_init();
        $url =  $id === "mysql" ? 'http://localhost:3000/mySql/summerisedata' : ($id === "mongo" ? 'http://localhost:3001/mongo/summarydata' : ($id === "elastic" ? "localhost:3002/elastic/summary" : ''));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = json_decode(curl_exec($ch), true);
        $total = count($response);
        $data['page'] = 'home';
        $data['data'] = $id === "elastic" ? array_slice($response, ($page - 1) * $perPage, $perPage)['aggregations']['group_by_hour']['buckets'] : array_slice($response, ($page - 1) * $perPage, $perPage);
        $data['pager'] = $this->pagers->makeLinks($page, $perPage, $total);
        echo view('/inc/template', $data);
    }
    public function overallReport($id)
    {
        $page = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;
        $perPage = 10;
        $data['id'] = $id;
        // Number of records per page 
        $ch = curl_init();
        $url =  $id === "mysql" ? 'http://localhost:3000/mySql/AllData' : ($id === "mongo" ? 'http://localhost:3001/mongo/alldata' : ($id === "elastic" ? "localhost:3002/elasticsearch/alldata" : ''));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = json_decode(curl_exec($ch), true);
        $total = count($response);
        $data['page'] = 'overall_report_page';
        $data['data'] = $id === "elastic" ? array_slice($response, ($page - 1) * $perPage, $perPage) : array_slice($response, ($page - 1) * $perPage, $perPage);
        $data['pager'] = $this->pagers->makeLinks($page, $perPage, $total);
        echo view('/inc/template', $data);
    }
    public function userState()
    {
        $data['page'] = '/agentdashboard/agent_state_page';
        return view('/inc/template',$data);
    }
}
