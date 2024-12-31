<?php

namespace App\Models;

use CodeIgniter\Model;

class CampaginModel extends Model
{
    protected $table            = 'createcampaign';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'description', 'client', 'supervisor'];

    public function createCampaign($name, $description, $client, $supervisor)
    {

        $checkCampaign = $this->where('name', $name)->first();

        if ($checkCampaign) {
            session()->setFlashData("sameCampaignError", "Campaign Name already exists");
            return      redirect()->to('/displayCreateCampaign');
        } else {
            $this->save([
                "name" => $name,
                "description" => $description,
                "client" => $client,
                "supervisor" => $supervisor
            ]);
        }

        return redirect()->to('/Campaigns');
    }
    public function DeleteCampaign($id)
    {
        $this->delete($id);
    }
    public function UpdateCampaign($id, $data)
    {
        $data =  $this->update($id, $data);
        return $data;
    }
    public function createProcess($name, $description, $client, $supervisor)
    {

        $this->campaign->save([
            "name" => $name,
            "description" => $description,
            "client" => $client,
            "supervisor" => $supervisor
        ]);

        return redirect()->to('/Campaigns');
    }
}
