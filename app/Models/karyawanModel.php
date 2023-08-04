<?php

namespace App\Models;

use CodeIgniter\Model;

class karyawanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'karyawan';
    protected $primaryKey       = 'karyawan';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['karyawan','nama'];
}