<?php

namespace App\Models;

use CodeIgniter\Model;

class Ulasan extends Model
{
    protected $table = 'ulasan';
    protected $primaryKey = 'id_ulasan';
    protected $allowedFields = ['id_paket_makeup', 'tanggal_ulasan', 'nama_costumer', 'ulasan'];


    public function getUlasan()
    {
        $data = $this->select('*')->join('paket_makeup p', 'ulasan.id_paket_makeup = p.id_paket_makeup', 'inner')->findAll();
        return $data;
    }
}
