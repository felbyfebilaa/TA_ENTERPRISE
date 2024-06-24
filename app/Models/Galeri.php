<?php

namespace App\Models;

use CodeIgniter\Model;

class Galeri extends Model
{
    protected $table = 'galeri';
    protected $primaryKey = 'id_galeri';
    protected $allowedFields = ['foto_galeri', 'deskripsi', 'nama_galeri'];


    public function getGaleri()
    {
        $db = db_connect();
        $query = "SELECT * FROM galeri";

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
