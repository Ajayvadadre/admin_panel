<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Firstname','Lastname','Username','Password','Accesslevel'];
    protected $createdField  = 'created_at';

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    public function DeleteUser($id){
        $this->delete($id);
    }
    public function UpdateUser($id) {
        $this->update($id);
    }
}
