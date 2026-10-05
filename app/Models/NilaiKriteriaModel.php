<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiKriteriaModel extends Model
{
    protected $table = 'nilai_kriteria';
    protected $primaryKey = 'id_nilai';
    protected $allowedFields = [
        'id_kriteria',
        'kategori',
        'nilai',
        'skor',
        'keterangan'
    ];

    public function getData()
    {
        return $this->select('nilai_kriteria.*, kriteria.nama_kriteria')
        ->join('kriteria', 'kriteria.id_kriteria = nilai_kriteria.id_kriteria')
        ->findAll();
    }
    public function getDatabyId($id)
    {
       return $this->select('nilai_kriteria.*, kriteria.nama_kriteria')
       ->join('kriteria', 'kriteria.id_kriteria = nilai_kriteria.id_kriteria')
       ->where('nilai_kriteria.id_nilai', $id)
       ->first(); 
   }
   public function getDatabyIdKriteria($id)
   {
       return $this->select('nilai_kriteria.*, kriteria.nama_kriteria')
       ->join('kriteria','kriteria.id_kriteria=nilai_kriteria.id_kriteria')
       ->where('nilai_kriteria.id_kriteria',$id)
       ->orderBy('skor','DESC')
       ->findAll();
   }
   public function getNilaiByKriteria($id_kriteria)
   {
    return $this->db->table('nilai_kriteria')
    ->where('id_kriteria', $id_kriteria)
    ->orderBy('skor')
    ->get()
    ->getResultArray();
}
}