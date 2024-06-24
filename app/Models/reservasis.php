<?php

namespace App\Models;

use CodeIgniter\Model;

class reservasis extends Model
{
    protected $table = 'reservasis';
    protected $primaryKey = 'id_reservasi';
    protected $allowedFields = ['id_paket', 'id_costumer', 'id_pembayaran', 'id_paket_makeup', 'tanggal_booking', 'tanggal_makeup', 'waktu_makeup', 'alamat_makeup', 'status_booking'];

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
        $query = "SELECT * FROM reservasis WHERE status_booking = 'Selesai'";
        $result = $db->query($query)->getResultArray();
        return $result;
    }

    public function pendingStatus()
    {
        $db = db_connect();
        $query = "SELECT * FROM reservasis WHERE status_booking = 'Menunggu'";
        $result = $db->query($query)->getResultArray();
        return $result;
    }

    public function getReservasi()
    {
        $data = $this->select('*')->join('customer c', 'reservasis.id_costumer = c.id_costumer', 'inner')->join('paket_makeup p', 'reservasis.id_paket_makeup = p.id_paket_makeup', 'inner')->findAll();
        return $data;
    }
}
