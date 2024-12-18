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
    protected $allowedFields    = ['name','description','client','supervisor'];

   
    public function DeleteCampaign($id){
        $this->delete($id);
    }
    public function UpdateCampaign($id,$data) {
        $data=  $this->update($id,$data);
        return $data;
     }
}
