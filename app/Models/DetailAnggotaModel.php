<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailAnggotaModel extends Model
{
    protected $table = 'detail_anggota';
    protected $primaryKey = 'id_anggota';
    protected $allowedFields = [
        'id_kk','no_kk','nik','nama','jenis_kelamin','tanggal_lahir',
        'hubungan_keluarga','id_pekerjaan','penghasilan_pribadi','pendidikan'
    ];

    public function getDatatables()
    {
        return $this->db->table('detail_anggota')
        ->select('
            detail_anggota.id_anggota,
            detail_anggota.nik,
            detail_anggota.nama,
            detail_anggota.jenis_kelamin,
            detail_anggota.tanggal_lahir,
            detail_anggota.hubungan_keluarga,
            detail_anggota.penghasilan_pribadi,
            detail_anggota.pendidikan,
            pekerjaan.nama_pekerjaan,
            keluarga.no_kk
            ')
        ->join('pekerjaan', 'pekerjaan.id_pekerjaan = detail_anggota.id_pekerjaan', 'left')
        ->join('keluarga', 'keluarga.id_kk = detail_anggota.id_kk', 'left')
        ->get()
        ->getResultArray();
    }
    public function deleteDetailKK($id_kk)
    {
        return $this->db->table('detail_anggota')
        ->where('id_kk', $id_kk)
        ->delete();
    }
   /* public function getByKK($id)
    {

        return $this->select('detail_anggota.*, pekerjaan.nama_pekerjaan')
        ->join('pekerjaan',
         'pekerjaan.id_pekerjaan=detail_anggota.id_pekerjaan')
        ->where('id_kk',$id)
        ->findAll();

    } */

    public function getByKK($id)
    {
        return $this->db->table('detail_anggota da')

        ->select('
            da.*,
            pa.nama_pekerjaan,
            k.no_kk,
            k.alamat,
            rt.nama_wilayah AS rt,
            rw.nama_wilayah AS rw,
            dusun.nama_wilayah AS dusun
            ')

        ->join('keluarga k', 'k.id_kk = da.id_kk')

        ->join('pekerjaan pa', 'pa.id_pekerjaan = da.id_pekerjaan', 'left')

        ->join('wilayah rt', 'rt.id_wilayah = k.id_rt', 'left')

        ->join('wilayah rw', 'rw.id_wilayah = rt.parent_id', 'left')

        ->join('wilayah dusun', 'dusun.id_wilayah = rw.parent_id', 'left')

        ->where('da.id_kk', $id)

        ->get()

        ->getResultArray();
    }


    public function getAnggotaKeluargaByIdKK($id_kk)
    {
        return $this->db->table('detail_anggota da')

        ->select('
            da.*,
            pa.nama_pekerjaan
            ')

        ->join('keluarga k', 'k.id_kk = da.id_kk')

        ->join('pekerjaan pa', 'pa.id_pekerjaan = da.id_pekerjaan')

        ->where('da.id_kk', $id_kk)

        ->get()

        ->getResultArray();
    }
   public function getByNoKK($no_kk)
{
    return $this->db->table('detail_anggota da')
        ->select('
            da.*,
            pa.nama_pekerjaan,
            k.no_kk,
            k.alamat,
            rt.nama_wilayah AS rt,
            rw.nama_wilayah AS rw,
            dusun.nama_wilayah AS dusun
        ')
        ->join('keluarga k', 'k.id_kk = da.id_kk')
        ->join('pekerjaan pa', 'pa.id_pekerjaan = da.id_pekerjaan', 'left')
        ->join('wilayah rt', 'rt.id_wilayah = k.id_rt', 'left')
        ->join('wilayah rw', 'rw.id_wilayah = rt.parent_id', 'left')
        ->join('wilayah dusun', 'dusun.id_wilayah = rw.parent_id', 'left')
        ->where('k.no_kk', $no_kk)
        ->orderBy('da.hubungan_keluarga', 'ASC')
        ->get()
        ->getResultArray();
}
    public function getEnumPendidikan()
    {
        $query = $this->db->query("SHOW COLUMNS FROM detail_anggota LIKE 'pendidikan'");

        $row = $query->getRowArray();

        preg_match("/^enum\(\'(.*)\'\)$/", $row['Type'], $matches);

        return explode("','", $matches[1]);
    }
    public function getKepalaKeluargaByNik($no_kk)
    {
        return $this->select('detail_anggota.*, pekerjaan.nama_pekerjaan')
        ->join('pekerjaan','pekerjaan.id_pekerjaan=detail_anggota.id_pekerjaan','left')
        ->join('keluarga','detail_anggota.id_kk=keluarga.id_kk')
        ->where('keluarga.no_kk',$no_kk)
        ->where('hubungan_keluarga','Kepala Keluarga')
        ->first();
    }
    public function getEnumJenisKelamin()
    {
        $query = $this->db->query("SHOW COLUMNS FROM detail_anggota LIKE 'jenis_kelamin'");

        $row = $query->getRowArray();

        preg_match("/^enum\(\'(.*)\'\)$/", $row['Type'], $matches);

        return explode("','", $matches[1]);
    }
    public function getEnumHubungan()
    {
        $query = $this->db->query("SHOW COLUMNS FROM detail_anggota LIKE 'hubungan_keluarga'");

        $row = $query->getRowArray();

        preg_match("/^enum\(\'(.*)\'\)$/", $row['Type'], $matches);

        return explode("','", $matches[1]);
    }

    public function getKepalaKeluarga($id_kk)
{
    return $this->db->table('detail_anggota')
        ->where('id_kk', $id_kk)
        ->where('hubungan_keluarga', 'Kepala Keluarga')
        ->get()
        ->getRowArray();
}
}