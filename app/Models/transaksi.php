<?php

namespace App\Models;

use CodeIgniter\Model;

class transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'Id_Transaksi';
    protected $allowedFields = ['Id_Reservasi', 'Biaya_Admin', 'Jumlah_Pembayaran', 'Jenis_Pembayaran', 'Tanggal_Transaksi', 'Bukti_Pembayaran'];

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
        $query = "SELECT * FROM transaksi A LEFT JOIN reservasi B ON A.Id_Reservasi = B.Id_Reservasi LEFT JOIN customer C ON B.NIK = C.NIK LEFT JOIN paket_foto D ON B.id_paket = D.id_paket LEFT JOIN rekening E ON A.Jenis_Pembayaran = E.id";

        return $db->query($query)->getResultArray();
    }

    public function successData($id)
    {
        $data = $this->select('*')->join('rekening', 'transaksi.Jenis_Pembayaran = rekening.id')->join('reservasi', 'transaksi.Id_Reservasi = reservasi.Id_Reservasi', 'left')->join('customer', 'reservasi.NIK = customer.NIK', 'left')->join('paket_foto', 'reservasi.id_paket = paket_foto.id_paket', 'left')->where('transaksi.Id_Transaksi', $id)->first();
        return $data;
    }
}
