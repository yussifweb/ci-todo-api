<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\TodosModel;

class Todos extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $model = new TodosModel();
        // $request = new Request();
        // $data = $model->findAll();
        $data = $model->findAll();
        // $code = $respond->getStatusCode();
        // $data = $respond->getResponseBody();
        return $this->respond($data);
    }
}