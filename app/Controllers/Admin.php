<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\EnrolmentModel;
use App\Models\TutorModel;
use App\Models\CourseModel;

class Admin extends BaseController
{
    private function ensureAdmin()
    {
        if (
            !session()->get('isLoggedIn') ||
            session()->get('user_role') !== 'admin'
        ) {
            return redirect()->to('/login');
        }
    }

    public function dashboard()
    {
        $this->ensureAdmin();

        $studentModel = new StudentModel();
        $enrolmentModel = new EnrolmentModel();
        $tutorModel  = new TutorModel();
        $courseModel = new CourseModel();

        $data = [
            'studentCount'   => $studentModel->countAll(),
            'tutorCount'     => $tutorModel->countAll(),
            'courseCount'    => $courseModel->countAll(),
            'enrolmentCount' => $enrolmentModel->countAll()
        ];

        return view('layout/header')
            . view('admin/dashboard', $data)
            . view('layout/footer');
    }

    public function students()
    {
        $this->ensureAdmin();

        $keyword = $this->request->getGet('q');

        $db = \Config\Database::connect();

        $builder = $db->table('students')
            ->select('students.student_id, students.name, students.contact, users.email')
            ->join('users', 'users.user_id = students.user_id');

        if ($keyword) {
            $builder->groupStart()
                ->like('students.name', $keyword)
                ->orLike('users.email', $keyword)
                ->groupEnd();
        }

        $students = $builder->get()->getResultArray();

        return view('layout/header')
            . view('admin/student', ['students' => $students])
            . view('layout/footer');
    }


    public function editStudent($id)
    {
        $this->ensureAdmin();

        $db = \Config\Database::connect();

        $student = $db->table('students')
            ->select('students.student_id, students.name, students.contact, users.email')
            ->join('users', 'users.user_id = students.user_id')
            ->where('students.student_id', $id)
            ->get()
            ->getRowArray();

        return view('layout/header')
            . view('admin/edit_student', ['student' => $student])
            . view('layout/footer');
    }

    public function updateStudent()
    {
        $this->ensureAdmin();

        $db = \Config\Database::connect();

        $db->table('students')
            ->where('student_id', $this->request->getPost('student_id'))
            ->update([
                'name'    => $this->request->getPost('name'),
                'contact' => $this->request->getPost('contact')
            ]);

        return redirect()->to('/admin/students');
    }
    public function deleteStudent($id)
    {
        $this->ensureAdmin();

        $db = \Config\Database::connect();
        $db->table('students')->where('student_id', $id)->delete();

        return redirect()->to('/admin/students');
    }


    protected $tutorModel;

    public function __construct()
    {
        $this->tutorModel = new TutorModel();
    }

    // LIST tutors
    public function tutors()
    {
        $this->ensureAdmin();

        $data['tutors'] = $this->tutorModel->findAll();

        return view('layout/header')
            . view('admin/tutor/index', $data)
            . view('layout/footer');
    }

    // CREATE form
    public function createTutor()
    {
        return view('layout/header')
            . view('admin/tutor/create')
            . view('layout/footer');
    }

    // STORE tutor
    public function storeTutor()
    {
        $image = $this->request->getFile('image');
        $imageName = null;

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move('image/tutors', $imageName); // public/image/tutors
        }

        $this->tutorModel->insert([
            'name'       => $this->request->getPost('name'),
            'contact'    => $this->request->getPost('contact'),
            'email'      => $this->request->getPost('email'),
            'image_path' => $imageName
        ]);

        return redirect()->to('/admin/tutors');
    }

    // EDIT form
    public function editTutor($id)
    {
        $data['tutor'] = $this->tutorModel->find($id);
        return view('layout/header')
            . view('admin/tutor/edit', $data)
            . view('layout/footer');
    }

    // UPDATE tutor
    public function updateTutor($id)
    {
        $tutor = $this->tutorModel->find($id);
        $image = $this->request->getFile('image');

        $imageName = $tutor['image_path'];

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move('image/tutors', $imageName);
        }

        $this->tutorModel->update($id, [
            'name'       => $this->request->getPost('name'),
            'contact'    => $this->request->getPost('contact'),
            'email'      => $this->request->getPost('email'),
            'image_path' => $imageName
        ]);

        return redirect()->to('/admin/tutors');
    }

    // DELETE tutor
    public function deleteTutor($id)
    {
        $this->tutorModel->delete($id);
        return redirect()->to('/admin/tutors');
    }

    // =====================
    // COURSES (ADMIN)
    // =====================

    // LIST courses
    public function courses()
    {
        $this->ensureAdmin();

        $keyword = $this->request->getGet('q');

        $courseModel = new \App\Models\CourseModel();

        if ($keyword) {
            $courseModel
                ->like('course_name', $keyword);
        }

        $courses = $courseModel->findAll();

        return view('layout/header')
            . view('admin/course/index', ['courses' => $courses])
            . view('layout/footer');
    }


    // CREATE form
    public function createCourse()
    {
        $this->ensureAdmin();

        $tutorModel = new \App\Models\TutorModel();

        return view('layout/header')
            . view('admin/course/create', [
                'tutors' => $tutorModel->findAll()
            ])
            . view('layout/footer');
    }


    // STORE course
    public function storeCourse()
    {
        $this->ensureAdmin();

        $courseModel = new CourseModel();

        $courseModel->insert([
            'course_name' => $this->request->getPost('course_name'),
            'price'       => $this->request->getPost('price'),
            'is_free'     => $this->request->getPost('is_free'),
            'tutor_id'    => $this->request->getPost('tutor_id')
        ]);


        return redirect()->to('/admin/course');
    }

    // EDIT form
    public function editCourse($id)
    {
        $this->ensureAdmin();

        $courseModel = new \App\Models\CourseModel();
        $tutorModel  = new \App\Models\TutorModel();

        return view('layout/header')
            . view('admin/course/edit', [
                'course' => $courseModel->find($id),
                'tutors' => $tutorModel->findAll()
            ])
            . view('layout/footer');
    }


    // UPDATE course
    public function updateCourse($id)
    {
        $this->ensureAdmin();

        $courseModel = new CourseModel();

        $courseModel->update($id, [
            'course_name' => $this->request->getPost('course_name'),
            'price'       => $this->request->getPost('price'),
            'is_free'     => $this->request->getPost('is_free'),
            'tutor_id'    => $this->request->getPost('tutor_id')
        ]);


        return redirect()->to('/admin/course');
    }

    // DELETE course
    public function deleteCourse($id)
    {
        $this->ensureAdmin();

        $courseModel = new CourseModel();
        $courseModel->delete($id);

        return redirect()->to('/admin/course');
    }
    // MAIN report page
    public function report()
    {
        $this->ensureAdmin();

        return view('layout/header')
            . view('admin/report/index')
            . view('layout/footer');
    }

    // PAYMENT REPORT
    public function reportPayment()
    {
        $this->ensureAdmin();

        $db = \Config\Database::connect();

        $payments = $db->table('enrolments')
            ->select('students.name, package.package_name, enrolments.payment_method, enrolments.payment_status')
            ->join('students', 'students.student_id = enrolments.student_id')
            ->join('package', 'package.package_id = enrolments.package_id')
            ->get()
            ->getResultArray();

        return view('admin/report/payment', ['payments' => $payments]);
    }

    // STUDENT REPORT
    public function reportStudent()
    {
        $this->ensureAdmin();

        $students = (new \App\Models\StudentModel())->findAll();

        return view('admin/report/student', ['students' => $students]);
    }

    // COURSE REPORT
    public function reportCourse()
    {
        $this->ensureAdmin();

        $courses = (new \App\Models\CourseModel())->findAll();

        return view('admin/report/course', ['courses' => $courses]);
    }

    // TUTOR REPORT
    public function reportTutor()
    {
        $this->ensureAdmin();

        $tutors = (new \App\Models\TutorModel())->findAll();

        return view('admin/report/tutor', ['tutors' => $tutors]);
    }
}
