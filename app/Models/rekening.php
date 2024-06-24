<?php

namespace App\Models;

use CodeIgniter\Model;

class rekening extends Model
{
    protected $table           = 'rekening';
    protected $allowedFields   = ['nama_rekening', 'atas_nama', 'no_rekening'];

    public function getRekenig($id)
    {
        return $this->where('id', $id)->first();
    }
}
