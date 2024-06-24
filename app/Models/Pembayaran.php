<?php

namespace App\Models;

use CodeIgniter\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $allowedFields = ['tanggal_pembayaran', 'jumlah_pembayaran', 'biaya_admin', 'total_pembayaran', 'bukti_transaksi', 'id_rekening', 'id_costumer'];

    public function getPembayaran()
    {
        $data = $this->select('*')->join('customer c', 'pembayaran.id_costumer = c.id_costumer', 'inner')->join('rekening r', 'pembayaran.id_rekening = r.id', 'inner')->findAll();
        return $data;
    }
}
