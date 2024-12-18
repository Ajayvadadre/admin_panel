<?php

namespace App\Models;

use CodeIgniter\Model;

class AccessLevel extends Model
{
    protected $table            = 'accesslevel';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'roles'];
    protected $createdField  = 'created_at';

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    public function getAccessLevels()
    {
        $accessLevelData =  $this->findAll();
           return $accessLevelData;
    }
}
