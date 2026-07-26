<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        return view('layout/header')
            . view('public/index')
            . view('layout/footer');
    }
    public function courses()
    {
        $courseModel = new \App\Models\CourseModel();
        $data['courses'] = $courseModel->findAll();

        return view('layout/header')
            . view('public/courses', $data)
            . view('layout/footer');
    }

    public function about()
    {
        return view('layout/header')
            . view('public/about')
            . view('layout/footer');
    }

    public function policy()
    {
        return view('layout/header')
            . view('public/policy')
            . view('layout/footer');
    }

    public function login()
    {
        return view('layout/header')
            . view('Auth/login')
            . view('layout/footer');
    }

    public function register()
    {
        return view('layout/header')
            . view('Auth/register')
            . view('layout/footer');
    }
    public function package()
    {
        $db = \Config\Database::connect();

        $data['packages'] = $db->table('package')->get()->getResultArray();

        return view('layout/header')
            . view('public/package', $data)
            . view('layout/footer');
    }
}
