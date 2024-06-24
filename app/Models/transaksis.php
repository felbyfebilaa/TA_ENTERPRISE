<?php

namespace App\Models;

use CodeIgniter\Model;

class transaksis extends Model
{
    protected $table = 'transaksis';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = ['id_reservasi', 'id_costumer', 'id_pembayaran', 'tanggal_transaksi'];

    public function countTransaksi()
    {
        $db = db_connect();
        $query = "SELECT * FROM transaksi";
        $count = "SELECT COUNT(*) as data FROM ($query) as Result";

        return $db->query($count)->getResultArray();
    }

    public function getDataTransaksi()
    {
        $db = db_connect();
//        $query = "SELECT * FROM transaksi A LEFT JOIN reservasi B ON A.Id_Reservasi = B.Id_Reservasi LEFT JOIN customer C ON B.NIK = C.NIK LEFT JOIN paket_foto D ON B.id_paket = D.id_paket LEFT JOIN rekening E ON A.Jenis_Pembayaran = E.id";
//        return $db->query($query)->getResultArray();

        $query = $this->select('*')->join('reservasis r', 'transaksis.id_reservasi = r.id_reservasi', 'inner')->join('paket_makeup pm', 'r.id_paket_makeup = pm.id_paket_makeup', 'inner')->join('customer c', 'r.id_costumer = c.id_costumer', 'inner')->join('pembayaran p', 'transaksis.id_pembayaran = p.id_pembayaran', 'inner')->join('rekening re', 'p.id_rekening = re.id', 'inner')->findAll();

        return $query;

    }

    public function successData($id)
    {
        $data = $this->select('*')->join('reservasis r', 'transaksis.id_reservasi = r.id_reservasi', 'inner')->join('paket_makeup pm', 'r.id_paket_makeup = pm.id_paket_makeup', 'inner')->join('customer c', 'r.id_costumer = c.id_costumer', 'inner')->join('pembayaran p', 'transaksis.id_pembayaran = p.id_pembayaran', 'inner')->join('rekening re', 'p.id_rekening = re.id', 'inner')->where('transaksis.id_transaksi', $id)->first();

//        var_dump($data);
//        exit();
        return $data;
    }
}
