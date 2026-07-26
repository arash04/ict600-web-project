<?php

namespace App\Models;

use CodeIgniter\Model;

class PackageModel extends Model
{
    protected $table = 'package';
    protected $primaryKey = 'package_id';

    protected $allowedFields = [
        'package_name',
        'price',
        'description'
    ];
}
