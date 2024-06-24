<?php

namespace App\Models;

use CodeIgniter\Model;

class paketFoto extends Model
{
    protected $table = 'paket_foto';
    protected $primaryKey = 'id_paket';
    protected $allowedFields = ['Nama_Paket', 'Deskripsi_Paket', 'Harga_Paket', 'Foto_Paket'];


    public function getPaket()
    {
        $db = db_connect();
        $query = "SELECT * FROM paket_foto";

        return $db->query($query)->getResultArray();
    }

    public function countPaket()
    {
        $db = db_connect();
        $query = "SELECT * FROM paket_foto";
        $count = "SELECT COUNT(*) as data FROM ($query) as Result";

        return $db->query($count)->getResultArray();
    }
}
