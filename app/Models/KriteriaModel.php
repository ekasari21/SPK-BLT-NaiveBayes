<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $table = 'kriteria';
    protected $primaryKey = 'id_kriteria';
    protected $allowedFields = ['kode_kriteria', 'nama_kriteria', 'keterangan'];
    public function getKriteria()
    {
        return $this->db->table('kriteria')
        ->orderBy('id_kriteria')
        ->get()
        ->getResultArray();
    }
}