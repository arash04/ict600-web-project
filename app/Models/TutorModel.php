<?php

namespace App\Models;

use CodeIgniter\Model;

class TutorModel extends Model
{
    protected $table = 'tutors';
    protected $primaryKey = 'tutor_id';

    protected $allowedFields = [
        'name',
        'contact',
        'email',
        'image_path'
    ];
}