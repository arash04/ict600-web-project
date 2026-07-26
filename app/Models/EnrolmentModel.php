<?php

namespace App\Models;

use CodeIgniter\Model;

class EnrolmentModel extends Model
{
    protected $table = 'enrolments';
    protected $primaryKey = 'enrolment_id';

    protected $allowedFields = [
        'student_id',
        'package_id',
        'payment_method',
        'payment_status'
    ];
}
