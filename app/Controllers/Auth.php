<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\StudentModel;


class Auth extends BaseController
{
    public function login()
    {
        return view('layout/header')
            . view('auth/login')
            . view('layout/footer');
    }

    public function attemptLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Invalid login credentials');
        }

        session()->set([
            'user_id' => $user['user_id'],
            'user_role' => $user['role'],
            'isLoggedIn' => true
        ]);

        $userRole = session()->get('user_role');

        if ($userRole === 'admin') {
            return redirect()->to('/admin/dashboard');
        }

        if ($userRole === 'student') {
            return redirect()->to('/student/dashboard');
        }

        // fallback (safety)
        return redirect()->to('/');

        if ($user['role'] === 'student') {
            return redirect()->to('/student/dashboard');
        }

        return redirect()->to('/admin');
    }

    public function register()
    {
        return view('layout/header')
            . view('auth/register')
            . view('layout/footer');
    }

    public function attemptRegister()
    {
        $userModel = new \App\Models\UserModel();
        $studentModel = new \App\Models\StudentModel();

        $email = $this->request->getPost('email');

        $password        = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if ($password !== $confirmPassword) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password and Confirm Password do not match.');
        }

        // ✅ CHECK IF EMAIL ALREADY EXISTS
        $existingUser = $userModel->where('email', $email)->first();

        if ($existingUser) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email is already taken');
        }

        // ✅ HASH PASSWORD
        $passwordHash = password_hash(
            $this->request->getPost('password'),
            PASSWORD_DEFAULT
        );

        // ✅ INSERT USER
        $userId = $userModel->insert([
            'name'    => $this->request->getPost('name'),
            'email'    => $email,
            'password' => $passwordHash,
            'role'     => 'student'
        ]);

        // ✅ INSERT STUDENT
        $studentModel->insert([
            'user_id' => $userId,
            'name'    => $this->request->getPost('name'),
            'contact' => $this->request->getPost('contact')
        ]);

        return redirect()->to('/login');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
