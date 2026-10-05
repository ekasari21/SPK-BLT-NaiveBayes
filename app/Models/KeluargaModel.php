<?php

namespace App\Models;
use CodeIgniter\Model;

class KeluargaModel extends Model
{
    protected $table = 'keluarga';
    protected $primaryKey = 'id_kk'; // sesuai DB kamu
    protected $allowedFields = [
        'no_kk',
        'alamat',
        'id_dusun',
        'id_rw',
        'id_rt',
        'jumlah_anggota',
    'created_at' // 🔥 WAJIB ADA
];
public function getDataWithWilayah()
{
    return $this->db->table('keluarga k')
    ->select('
        k.id_kk, 
        k.no_kk,
        k.alamat,
        k.jumlah_anggota,

        rt.id_wilayah AS id_rt,
        rw.id_wilayah AS id_rw,
        dusun.id_wilayah AS id_dusun,

        rt.nama_wilayah AS nama_rt,
        rw.nama_wilayah AS nama_rw,
        dusun.nama_wilayah AS nama_dusun
        ')
        // 🔥 ambil RT dari keluarga
    ->join('wilayah rt', 'rt.id_wilayah = k.id_rt', 'left')

        // 🔥 ambil RW dari parent RT
    ->join('wilayah rw', 'rw.id_wilayah = rt.parent_id', 'left')

        // 🔥 ambil Dusun dari parent RW
    ->join('wilayah dusun', 'dusun.id_wilayah = rw.parent_id', 'left')

    ->get()
    ->getResultArray();
}

public function cekKKbyId($no_kk)
{
    return $this->db->table('keluarga k')
    ->select([
        'k.no_kk',
        'k.alamat',
        'k.jumlah_anggota',
        'dusun.nama_wilayah AS nama_dusun',
        'rw.nama_wilayah AS nama_rw',
        'rt.nama_wilayah AS nama_rt',
        'da.nama AS kepala_keluarga'
    ])
    ->join(
        'detail_anggota da',
        'da.id_kk = k.id_kk AND da.hubungan_keluarga = "Kepala Keluarga"',
        'left'
    )
    ->join('wilayah dusun', 'dusun.id_wilayah = k.id_dusun')
    ->join('wilayah rw', 'rw.id_wilayah = k.id_rw')
    ->join('wilayah rt', 'rt.id_wilayah = k.id_rt')
    ->where('k.no_kk', $no_kk)
    ->get()
    ->getRowArray();
}

public function cekKeluargaByIDKK($id_kk)
{
    return $this->db->table('keluarga k')
        ->select([
            'k.id_kk',
            'k.no_kk',
            'k.alamat',
            'k.jumlah_anggota'
        ])
        ->join('detail_anggota da', 'da.id_kk = k.id_kk')
        ->join('dataset dt', 'dt.id_kk = k.id_kk')
        ->where('k.id_kk', $id_kk)
        ->where('dt.status', 'Training')
        ->get()
        ->getRowArray();
}

public function cekKeluargaByIDKlasifikasi($id_kk)
{
    return $this->db->table('keluarga k')
        ->select([
            'k.id_kk',
            'k.no_kk',
            'k.alamat',
            'k.jumlah_anggota'
        ])
        ->join('detail_anggota da', 'da.id_kk = k.id_kk')
        ->join('dataset dt', 'dt.id_kk = k.id_kk')
        ->where('k.id_kk', $id_kk)
        ->where('dt.status', 'Testing')
        ->get()
        ->getRowArray();
}

public function detailKKbyID($no_kk)
{
    return $this->db->table('keluarga k')
    ->select('
        k.*,
        dusun.nama_wilayah AS dusun,
        rw.nama_wilayah AS rw,
        rt.nama_wilayah AS rt
        ')
    ->join('wilayah dusun', 'dusun.id_wilayah = k.id_dusun', 'left')
    ->join('wilayah rw', 'rw.id_wilayah = k.id_rw', 'left')
    ->join('wilayah rt', 'rt.id_wilayah = k.id_rt', 'left')
    ->where('k.no_kk', $no_kk)
    ->get()
    ->getRowArray();
}
public function getByNoKK($no_kk)
{
    return $this->db->table('detail_anggota da')
    ->select('
        k.no_kk,
        da.nik,
        da.nama,
        da.jenis_kelamin,
        da.tanggal_lahir,
        da.hubungan_keluarga,
        p.nama_pekerjaan,
        da.penghasilan_pribadi,
        da.pendidikan
        ')
    ->join('keluarga k', 'k.id_kk = da.id_kk')
    ->join('pekerjaan p', 'p.id_pekerjaan = da.id_pekerjaan', 'left')
    ->where('k.no_kk', $no_kk)
    ->get()
    ->getResultArray();
}
public function getKepalaKeluarga($no_kk)
{
    return $this->db->table('detail_anggota da')
    ->select('
        da.nama
        ')
    ->join('keluarga k', 'k.id_kk = da.id_kk')
    ->join('pekerjaan p', 'p.id_pekerjaan = da.id_pekerjaan', 'left')
    ->where('k.no_kk', $no_kk)
    ->where('da.hubungan_keluarga', 'Kepala Keluarga')
    ->get()
    ->getRowArray();
}




public function getDataCalonTraining($keyword = null)
{
    $builder = $this->db->table('keluarga k');

    $builder->select("
        k.id_kk,
        k.no_kk,
        k.jumlah_anggota,
        k.alamat,
        da.nama,
        da.hubungan_keluarga
    ");

    $builder->join('detail_anggota da', 'da.id_kk = k.id_kk');

    // JOIN ke tabel dataset
    $builder->join('dataset ds', 'ds.id_kk = k.id_kk', 'left');

    // Hanya ambil keluarga yang BELUM ada pada dataset
    $builder->where('ds.id_kk IS NULL', null, false);

       if (!empty($keyword)) {

    $builder->groupStart()
            ->like('k.no_kk', $keyword)
            ->orGroupStart()
                ->where('da.hubungan_keluarga', 'Kepala Keluarga')
                ->like('da.nama', $keyword)
            ->groupEnd()
            ->groupEnd();
    }
    $builder->orderBy('k.no_kk', 'ASC');

    $result = $builder->get()->getResultArray();

    $data = [];

    foreach ($result as $row) {

        $id = $row['id_kk'];

        if (!isset($data[$id])) {

            $data[$id] = [
                'id_kk'             => $row['id_kk'],
                'no_kk'             => $row['no_kk'],
                'jumlah_anggota'    => $row['jumlah_anggota'],
                'alamat'            => $row['alamat'],
                'kepala_keluarga'   => '',
                'anggota'           => []
            ];
        }

        if ($row['hubungan_keluarga'] == 'Kepala Keluarga') {

            $data[$id]['kepala_keluarga'] = $row['nama'];

        } else {

            $data[$id]['anggota'][] = $row['nama'];

        }
    }

    return array_values($data);
}

}