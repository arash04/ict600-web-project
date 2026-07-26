<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TutorModel;

class Tutor extends BaseController
{
    public function index()
    {
        $model = new TutorModel();
        $data['tutors'] = $model->findAll();

        return view('tutor/index', $data);
    }
}
