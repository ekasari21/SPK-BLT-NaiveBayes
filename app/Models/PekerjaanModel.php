<?php

namespace App\Models;

use CodeIgniter\Model;

class PekerjaanModel extends Model
{
    protected $table = 'pekerjaan';
    protected $primaryKey = 'id_pekerjaan';
    protected $allowedFields = ['nama_pekerjaan'];

    public function ambilDataPekerjaan()
    {
        return $this->db->table('pekerjaan')
        ->orderBy('nama_pekerjaan','ASC')
        ->get()
        ->getResultArray();
    }

}
?>