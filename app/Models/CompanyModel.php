<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $table         = 'company';
    protected $primaryKey    = 'COMPANYID';
    protected $allowedFields = ['COMPANYID', 'COMPANYNAME', 'ADDRESS', 'CITY', 'PROVINCE'];
}
