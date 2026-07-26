<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\UserModel;
use App\Models\PackageModel;
use App\Models\EnrolmentModel;
use App\Models\CourseModel;

class Student extends BaseController
{
    /* ===============================
       Helper: enrolment status
    =============================== */
    private function setEnrolmentStatus()
    {
        $db = \Config\Database::connect();

        $hasEnrolment = $db->table('enrolments')
            ->join('students', 'students.student_id = enrolments.student_id')
            ->where('students.user_id', session()->get('user_id'))
            ->countAllResults() > 0;

        session()->set('hasEnrolment', $hasEnrolment);
    }

    /* ===============================
       Dashboard
    =============================== */
    public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $this->setEnrolmentStatus();

        $db = \Config\Database::connect();

        $enrolment = $db->table('enrolments')
            ->join('students', 'students.student_id = enrolments.student_id')
            ->join('package', 'package.package_id = enrolments.package_id')
            ->where('students.user_id', session()->get('user_id'))
            ->get()
            ->getRowArray();

        return view('layout/header')
            . view('student/dashboard', ['enrolment' => $enrolment])
            . view('layout/footer');
    }

    /* ===============================
       Profile
    =============================== */
    public function profile()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $this->setEnrolmentStatus();

        $studentModel = new StudentModel();
        $userModel    = new UserModel();

        $student = $studentModel->where('user_id', session()->get('user_id'))->first();
        $user    = $userModel->find(session()->get('user_id'));

        return view('layout/header')
            . view('student/profile', compact('student', 'user'))
            . view('layout/footer');
    }

    public function edit()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $studentModel = new StudentModel();
        $student = $studentModel->where('user_id', session()->get('user_id'))->first();

        return view('layout/header')
            . view('student/edit_profile', ['student' => $student])
            . view('layout/footer');
    }

    public function update()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $studentModel = new StudentModel();
        $student = $studentModel->where('user_id', session()->get('user_id'))->first();

        $image = $this->request->getFile('image');
        $imageName = $student['image_path'];

        if ($image && $image->isValid()) {
            $imageName = $image->getRandomName();
            $image->move('image/students', $imageName);
        }

        $studentModel->update($student['student_id'], [
            'name'       => $this->request->getPost('name'),
            'contact'    => $this->request->getPost('contact'),
            'image_path' => $imageName
        ]);

        return redirect()->to('/student/profile');
    }

    /* ===============================
       Package selection
    =============================== */
    public function enrol()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $this->setEnrolmentStatus();

        if (session()->get('hasEnrolment')) {
            return redirect()->to('/student/enrolment');
        }

        $packageModel = new PackageModel();

        return view('layout/header')
            . view('student/enrol', ['package' => $packageModel->findAll()])
            . view('layout/footer');
    }

    public function processEnrol()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $studentModel = new StudentModel();
        $enrolmentModel = new EnrolmentModel();

        $student = $studentModel->where('user_id', session()->get('user_id'))->first();

        $enrolmentModel->insert([
            'student_id'     => $student['student_id'],
            'package_id'     => $this->request->getPost('package_id'),
            'payment_method' => $this->request->getPost('payment_method'),
            'payment_status' => 'Paid'
        ]);

        session()->set('hasEnrolment', true);

        return redirect()->to('/student/enrolment');
    }

    public function enrolment()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $this->setEnrolmentStatus();

        if (!session()->get('hasEnrolment')) {
            return redirect()->to('/student/enrol');
        }

        $db = \Config\Database::connect();

        $enrolment = $db->table('enrolments')
            ->join('package', 'package.package_id = enrolments.package_id')
            ->join('students', 'students.student_id = enrolments.student_id')
            ->where('students.user_id', session()->get('user_id'))
            ->get()
            ->getRowArray();

        $customCourses = $db->table('student_courses')
            ->join('courses', 'courses.course_id = student_courses.course_id')
            ->join('students', 'students.student_id = student_courses.student_id')
            ->where('students.user_id', session()->get('user_id'))
            ->get()
            ->getResultArray();


        return view('layout/header')
            . view('student/my_enrolment', [
                'enrolment' => $enrolment,
                'customCourses' => $customCourses
            ])
            . view('layout/footer');
    }

    /* ===============================
       COURSES LIST (KEY FIX)
    =============================== */
    public function courses()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $this->setEnrolmentStatus();

        if (!session()->get('hasEnrolment')) {
            return redirect()->to('/student/enrol');
        }

        $courseModel = new CourseModel();

        $keyword = $this->request->getGet('q');
        if ($keyword) {
            $courseModel->like('course_name', $keyword);
        }

        // ✅ ALL students see ALL courses
        $courses = $courseModel->findAll();

        return view('layout/header')
            . view('student/courses', ['courses' => $courses])
            . view('layout/footer');
    }

    /* ===============================
       COURSE DETAIL (ACCESS CONTROL)
    =============================== */
    public function courseDetail($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();

        $student = $db->table('students')
            ->where('user_id', session()->get('user_id'))
            ->get()
            ->getRowArray();

        if (!$student) {
            return redirect()->to('/student/enrol');
        }

        $enrolment = $db->table('enrolments')
            ->join('package', 'package.package_id = enrolments.package_id')
            ->where('enrolments.student_id', $student['student_id'])
            ->get()
            ->getRowArray();

        if (!$enrolment) {
            return redirect()->to('/student/enrol');
        }

        $packageName = strtolower($enrolment['package_name']);

        $courseModel = new CourseModel();
        $course = $courseModel->find($id);

        if (!$course) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $hasBought = $db->table('student_courses')
            ->where('student_id', $student['student_id'])
            ->where('course_id', $id)
            ->countAllResults() > 0;

        return view('layout/header')
            . view('student/course_detail', compact('course', 'packageName', 'hasBought'))
            . view('layout/footer');
    }

    /* ===============================
       BUY COURSE
    =============================== */
    public function buyCourse($courseId)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();

        // get student
        $student = $db->table('students')
            ->where('user_id', session()->get('user_id'))
            ->get()
            ->getRowArray();

        if (!$student) {
            return redirect()->to('/student/enrol');
        }

        // get course
        $courseModel = new \App\Models\CourseModel();
        $course = $courseModel->find($courseId);

        if (!$course || $course['is_free']) {
            return redirect()->to('/student/courses');
        }

        return view('layout/header')
            . view('student/buy_course', ['course' => $course])
            . view('layout/footer');
    }
    public function processBuyCourse($courseId)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();

        $student = $db->table('students')
            ->where('user_id', session()->get('user_id'))
            ->get()
            ->getRowArray();

        if (!$student) {
            return redirect()->to('/student/enrol');
        }

        // prevent duplicate purchase
        $exists = $db->table('student_courses')
            ->where('student_id', $student['student_id'])
            ->where('course_id', $courseId)
            ->countAllResults();

        if ($exists == 0) {
            $db->table('student_courses')->insert([
                'student_id' => $student['student_id'],
                'course_id'  => $courseId
            ]);
        }

        return redirect()->to('/student/course/' . $courseId);
    }
}
