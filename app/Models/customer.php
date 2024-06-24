<?php

namespace App\Models;

use CodeIgniter\Model;

class customer extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id_costumer';
    protected $allowedFields = ['Nama', 'NIK', 'No_HP', 'Alamat'];
//    protected $useAutoIncrement = false;

    public function countCustomer()
    {
        $db = db_connect();
        $query = "SELECT * FROM customer";
        $count = "SELECT COUNT(*) as data FROM ($query) as Result";

        return $db->query($count)->getResultArray();
    }

    public function isRegistered($nama, $nik)
    {
        $db = db_connect();
        $query = "SELECT CASE WHEN EXISTS (select * from customer where Nama like '%$nama%' and NIK = '$nik') THEN 1 ELSE 0 END AS data";

        return $db->query($query)->getResultArray();
    }

    public function isCekCostumer($nama, $nik)
    {
        $db = db_connect();
        $query = "SELECT * from customer where Nama like '%$nama%' and NIK = '$nik'";

        return $db->query($query)->getRowArray();
    }

    public function checkNIK($nik)
    {
        $db = db_connect();
        $query = "SELECT CASE WHEN EXISTS (select * from customer where NIK = '$nik') THEN 1 ELSE 0 END AS data";

        return $db->query($query)->getResultArray();
    }

    public function findCustomer($input)
    {
        if ($input == '' || $input == null) {
            $data = $this->findAll();
        } else {
            $data = $this->select('*')->like('Nama', $input)->orLike('NIK', $input)->orLike('No_HP', $input)->orLike('Alamat', $input)->findAll();
        }

        return $data;
    }
}
