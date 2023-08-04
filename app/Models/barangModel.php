<?php

namespace App\Models;

use CodeIgniter\Model;

class barangModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'barang';
    protected $primaryKey       = 'barang';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['barang','jenis_barang','kode_barang'];
}