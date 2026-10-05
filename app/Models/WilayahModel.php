<?php

namespace App\Models;
use CodeIgniter\Model;

class WilayahModel extends Model
{
    protected $table = 'wilayah';
    protected $primaryKey = 'id_wilayah';
    protected $allowedFields = ['nama_wilayah', 'jenis', 'parent_id'];
    public function getDetailWilayah($id)
    {
        return $this->db->table('wilayah rt')
        ->select('
            rt.id_wilayah,
            rt.nama_wilayah AS rt,
            rw.nama_wilayah AS rw,
            dusun.nama_wilayah AS dusun
            ')
        ->join('wilayah rw', 'rw.id_wilayah = rt.parent_id')
        ->join('wilayah dusun', 'dusun.id_wilayah = rw.parent_id')
        ->where('dusun.id_wilayah', $id)
        ->get()
        ->getRowArray();
    }
    
} 