<?php

namespace App\Models;

use CodeIgniter\Model;

class item_barangModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'item_barang';
    protected $primaryKey       = 'item_barang';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['jumlah_barang','sisa_barang','tambahan'];
}

   