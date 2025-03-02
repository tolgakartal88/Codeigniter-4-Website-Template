<?php

namespace App\Models;

use CodeIgniter\Model;

class UserPreferenceModel extends Model
{
    protected $table      = 'user_preferences';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['set_key','set_value'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at'; 

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ["CheckData"];
    protected $beforeUpdateBatch   = ["CheckData"];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function CheckData(array $data)
    {
        foreach ($data["data"] as $key => $value) {
            if($value["set_value"]=="reupdate"){
                unset($data["data"][$key]);
            }
        }
        var_dump($data);
        return $data;
        
    }
}