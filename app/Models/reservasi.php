<?php

namespace App\Models;

use CodeIgniter\Model;

class reservasi extends Model
{
    protected $table = 'reservasi';
    protected $primaryKey = 'Id_Reservasi';
    protected $allowedFields = ['NIK', 'id_paket', 'Tanggal_Reservasi', 'Tanggal_Pemotretan', 'Waktu', 'Alamat_Pemotretan', 'status'];

    public function findReservasi($nik, $tgl_reservasi)
    {
        $db = db_connect();
        $query = "SELECT * FROM reservasi WHERE NIK = '$nik' AND Tanggal_Reservasi = '$tgl_reservasi'";
        $data = $db->query($query)->getResultArray();

        return $data;
    }

    public function doneStatus()
    {
        $db = db_connect();
        $query = "SELECT * FROM reservasi WHERE status = 2";
        $data = "SELECT COUNT(*) as selesai FROM ($query) as Result";
        $result = $db->query($data)->getResultArray();
        return $result[0];
    }

    public function getReservasi()
    {
        $data = $this->select('*')->join('customer', 'reservasi.NIK = customer.NIK', 'left')->join('paket_foto', 'reservasi.id_paket = paket_foto.id_paket', 'left')->findAll();
        return $data;
    }
}
