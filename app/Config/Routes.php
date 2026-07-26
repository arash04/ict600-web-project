<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Pages::index');
$routes->get('/about', 'Pages::about');
$routes->get('/package', 'Pages::package');
$routes->get('/policy', 'Pages::policy');
$routes->get('/courses', 'Pages::courses');
$routes->get('/tutor', 'Tutor::index');


$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attemptLogin');
$routes->get('/logout', 'Auth::logout');


$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::attemptRegister');


$routes->get('/student/dashboard', 'Student::dashboard');
$routes->get('/student/profile', 'Student::profile');
$routes->get('/student/edit', 'Student::edit');
$routes->post('/student/update', 'Student::update');
$routes->get('/student/enrol', 'Student::enrol');
$routes->post('/student/enrol', 'Student::processEnrol');
$routes->get('/student/courses', 'Student::courses');
$routes->get('/student/enrolment', 'Student::enrolment');
$routes->get('/student/course/(:num)', 'Student::courseDetail/$1');
$routes->get('student/buy-course/(:num)', 'Student::buyCourse/$1');
$routes->post('student/buy-course/(:num)', 'Student::processBuyCourse/$1');


$routes->get('/admin', 'Admin::dashboard');
$routes->get('admin/dashboard', 'Admin::dashboard');
$routes->get('/admin/students', 'Admin::students');
$routes->get('/admin/students/edit/(:num)', 'Admin::editStudent/$1');
$routes->post('/admin/students/update', 'Admin::updateStudent');
$routes->get('admin/students/delete/(:num)', 'Admin::deleteStudent/$1');

$routes->get('admin/tutors', 'Admin::tutors');
$routes->get('admin/tutors/create', 'Admin::createTutor');
$routes->post('admin/tutors/store', 'Admin::storeTutor');
$routes->get('admin/tutors/edit/(:num)', 'Admin::editTutor/$1');
$routes->post('admin/tutors/update/(:num)', 'Admin::updateTutor/$1');
$routes->get('admin/tutors/delete/(:num)', 'Admin::deleteTutor/$1');

$routes->get('admin/course', 'Admin::courses');
$routes->get('admin/course/create', 'Admin::createCourse');
$routes->post('admin/course/store', 'Admin::storeCourse');
$routes->get('admin/course/edit/(:num)', 'Admin::editCourse/$1');
$routes->post('admin/course/update/(:num)', 'Admin::updateCourse/$1');
$routes->get('admin/course/delete/(:num)', 'Admin::deleteCourse/$1');

$routes->get('/admin/report', 'Admin::report');
$routes->get('/admin/report/payment', 'Admin::reportPayment');
$routes->get('/admin/report/student', 'Admin::reportStudent');
$routes->get('/admin/report/course', 'Admin::reportCourse');
$routes->get('/admin/report/tutor', 'Admin::reportTutor');

