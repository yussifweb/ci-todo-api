<?php

namespace App\Models;

use CodeIgniter\Model;

class TodosModel extends Model
{
    protected $table = 'todos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'completed'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
