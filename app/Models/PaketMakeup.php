<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketMakeup extends Model
{
    protected $table = 'paket_makeup';
    protected $primaryKey = 'id_paket_makeup';
    protected $allowedFields = ['nama_paket_makeup', 'deskripsi_paket_makeup', 'harga_paket_makeup', 'foto_paket_makeup'];


    public function getPaket()
    {
        $db = db_connect();
        $query = "SELECT * FROM paket_makeup";

        return $db->query($query)->getResultArray();
    }

    public function countPaket()
    {
        $db = db_connect();
        $query = "SELECT * FROM paket_makeup";
        $count = "SELECT COUNT(*) as data FROM ($query) as Result";

        return $db->query($count)->getResultArray();
    }
}
