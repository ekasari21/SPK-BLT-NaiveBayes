<?php

namespace App\Models;
use CodeIgniter\Model;

class PersetujuanModel extends Model
{
    protected $table = 'persetujuan_penerima';
    protected $primaryKey = 'id_persetujuan';
    protected $allowedFields = ['id_hasil', 'id_user', 'status','catatan','tgl_persetujuan'];


    public function getHasilPersetujuan($id)
    {
        return $this->db->table('hasil_prediksi hp')
        ->select('
            hp.*,
            pp.id_persetujuan,
            pp.id_user,
            pp.status,
            pp.catatan,
            pp.tgl_persetujuan
            ')
        ->join('persetujuan_penerima pp', 'pp.id_hasil = hp.id_hasil', 'left')
        ->where('hp.id_hasil', $id)
        ->get()
        ->getRowArray();
    }
    public function jmlDisetujui(){
        return  $this->db->table('persetujuan_penerima')
        ->where('status', 'Disetujui')
        ->countAllResults();
    }
    public function jmlDitolak(){
     return  $this->db->table('persetujuan_penerima')
     ->where('status', 'Ditolak')
     ->countAllResults();
 }
 public function getDataHasilPersetujuan($tglAwal = null, $tglAkhir = null, $status = null)
 {
    $builder = $this->db->table('hasil_prediksi hp')
    ->select("
        hp.id_hasil,
        hp.id_dataset,

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

        da.nama AS kepala_keluarga,

        pp.id_persetujuan,
        pp.status AS hasil_persetujuan,
        pp.catatan,
        pp.tgl_persetujuan
        ")
    ->join('dataset d', 'd.id_dataset = hp.id_dataset')
    ->join('keluarga k', 'k.id_kk = d.id_kk')
    ->join('detail_anggota da', 'da.id_kk = k.id_kk')
    ->join('persetujuan_penerima pp', 'pp.id_hasil = hp.id_hasil')
    ->where('d.status', 'Testing')
    ->where('da.hubungan_keluarga', 'Kepala Keluarga');

    // Filter status
    if (!empty($status)) {
        $builder->where('pp.status', $status);
    }

    // Filter tanggal
    if (!empty($tglAwal) && !empty($tglAkhir)) {
        $builder->where('pp.tgl_persetujuan >=', $tglAwal);
        $builder->where('pp.tgl_persetujuan <=', $tglAkhir);
    }

    $builder->orderBy('k.no_kk', 'ASC');

    return $builder->get()->getResultArray();
}
public function getDataCalonPersetujuan()
{
    return $this->db->table('hasil_prediksi hp')
    ->select("
        hp.id_hasil,
        hp.id_dataset,
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
        k.alamat,
        k.jumlah_anggota,

        da.nama AS kepala_keluarga,

        pp.id_persetujuan,
        pp.status AS hasil_persetujuan,
        pp.catatan,
        pp.tgl_persetujuan
        ")
    ->join('dataset d', 'd.id_dataset = hp.id_dataset')
    ->join('keluarga k', 'k.id_kk = d.id_kk')
    ->join(
        'detail_anggota da',
        "da.id_kk = k.id_kk AND da.hubungan_keluarga = 'Kepala Keluarga'"
    )
    ->join('persetujuan_penerima pp', 'pp.id_hasil = hp.id_hasil', 'left')
    ->where('d.status', 'Testing')
        ->where('hp.hasil', 'Layak')          // hanya hasil prediksi Layak
        ->where('pp.id_persetujuan IS NULL', null, false) // belum diproses
        ->orderBy('k.no_kk', 'ASC')
        ->get()
        ->getResultArray();
    }
    public function cekStatusKelayakan($noKK)
    {
        return $this->db->table('keluarga k')
        ->select('
            k.no_kk,
            d.id_dataset,
            d.label_prediksi,
            hp.hasil,
            hp.probabilitas_layak,
            hp.probabilitas_tidak_layak,
            pp.id_persetujuan,
            pp.status as status_persetujuan,
            pp.catatan
            ')
        ->join('dataset d','d.id_kk=k.id_kk')
        ->join('hasil_prediksi hp','hp.id_dataset=d.id_dataset','left')
        ->join('persetujuan_penerima pp','pp.id_hasil=hp.id_hasil','left')
        ->where('k.no_kk',$noKK)
        ->where('d.status','Testing')
        ->get()
        ->getRowArray();
    }

}