<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilPrediksiModel extends Model
{
    protected $table = 'hasil_prediksi';
    protected $primaryKey = 'id_hasil';

    protected $allowedFields = [
        'id_dataset',
        'probabilitas_layak',
        'probabilitas_tidak_layak',
        'hasil',
        'tanggal_status'
    ];

    public function getDataHasilKlasifikasi()
    {
        return $this->db->table('hasil_prediksi hp')
        ->select("
            hp.id_hasil,
            hp.id_dataset,
            hp.probabilitas_layak,
            hp.probabilitas_tidak_layak,
            hp.hasil,

            d.kepemilikan_kendaraan,
            d.kepemilikan_rumah,
            d.kondisi_rumah,
            d.kepemilikan_tanah,
            d.penghasilan,
            d.tanggungan,
            d.usia,
            d.pekerjaan,
            k.id_kk,
            k.no_kk,

            da.nama as kepala_keluarga
            ")
        ->join('dataset d','d.id_dataset=hp.id_dataset')
        ->join('keluarga k','k.id_kk=d.id_kk')
        ->join('detail_anggota da','da.id_kk=k.id_kk')
        ->where('d.status','Testing')
        ->where('da.hubungan_keluarga','Kepala Keluarga')
        ->orderBy('k.no_kk','ASC')
        ->get()
        ->getResultArray();
    }
    
    public function jmlKlasifikasiLayak(){
        return $jumlahTraining = $this->db->table('hasil_prediksi')
        ->where('hasil', 'Layak')
        ->countAllResults();
    }
    public function jmlKlasifikasiTidakLayak(){
        return $jumlahTraining = $this->db->table('hasil_prediksi')
        ->where('hasil', 'Tidak Layak')
        ->countAllResults();
    }
    public function resetKlasifikasi(){
     return $this->db->table('hasil_prediksi')
     ->where('id_hasil NOT IN (SELECT id_hasil FROM persetujuan_penerima)', null, false)
     ->delete();

 }

}