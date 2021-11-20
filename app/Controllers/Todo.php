<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Todo extends ResourceController
{
    protected $modelName = 'App\Models\TodoModel';
    protected $format = 'json';

    public function index()
    {
        $todos = $this->model->findAll();
        // $todos = json_decode(`string $todos`, true);
        // $todos = json_encode($todos, JSON_NUMERIC_CHECK);

        return $this->respond($todos);
    }

    public function create()
    {
        helper(['form']);

        $rules = [
            'title' => 'required',
            'completed' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }else {
            $data = [
                'title' => $this->request->getVar('title'),
                'completed' => $this->request->getVar('completed', FILTER_VALIDATE_BOOL)
                // 'completed' => $this->request->getVar('completed')
            ];

            $id = $this->model->insert($data);
            $data['id'] = $id;

            return $this->respondCreated($data);
        }       
    }


    public function show($id = null)
    {
        $data = $this->model->find($id);
        return $this->respond($data);
    }

    public function update($id = null)
    {
        helper(['form']);

        $rules = [
            'title' => 'required',
            'completed' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            // $input = $this->request->getRawInput();

            $title = $this->request->getVar('title');
            $completed = $this->request->getVar('completed', FILTER_VALIDATE_BOOL);            

            $data = [
                'id' => $id,
                'title' => $title,
                'completed' => $completed
            ];

            $this->model->save($data);

            return $this->respond($data);
        }
    }

    public function delete($id = null)
    {
        $data = $this->model->find($id);

        if ($data) {
            $this->model->delete($data);
            return $this->respondDeleted($data);
        } else {
            return $this->failNotFound('Todo not found');
        }        
    }

}
