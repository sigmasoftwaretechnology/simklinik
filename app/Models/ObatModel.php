<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'obat';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
	protected $protectFields    = false;
}
