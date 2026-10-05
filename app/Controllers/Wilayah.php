<?php

namespace App\Controllers;

use App\Models\WilayahModel;
use PhpOffice\PhpSpreadsheet\IOFactory;


class Wilayah extends BaseController
{
    protected $model;

    // controller utama
    public function __construct()
    {
        $this->model = new WilayahModel();
    }

    public function index()
    {

        $jumlahDusun = $this->model->where('jenis', 'dusun')->countAllResults();
        $jumlahRW= $this->model->where('jenis', 'rw')->countAllResults();
        $jumlahRt= $this->model->where('jenis', 'rt')->countAllResults();


        $status = $this->request->getGet('edit'); // ambil ?status=on

    $isEditable = ($status === 'on'); // true kalau on

    // ambil data keluarga
    $data = [
        'dusun'  =>  $this->model->where('jenis', 'dusun')->findAll(),
        'isEditable' => $isEditable,
        'jmlDusun' => $jumlahDusun,
        'jmlRW'=> $jumlahRW,
        'jmlRT' => $jumlahRt
    ];

    return view('wilayah/wilayah_view', $data);
}
    // kontroller untuk menampilkan data pada datatables
// kontroller untuk menampilkan data pada datatables
public function getData()
{
    // 1. Ambil parameter ?dusun= yang dikirim oleh AJAX DataTables
    $filterDusun = $this->request->getGet('dusun');

    // Tetap ambil semua data untuk kebutuhan mapping relasi antar-level
    $data = $this->model->findAll();

    $map = [];
    foreach ($data as $d) {
        $map[$d['id_wilayah']] = $d;
    }

    $hasChild = [];
    foreach ($data as $d) {
        if (!empty($d['parent_id'])) {
            $hasChild[$d['parent_id']] = true;
        }
    }

    $result = [];
    $no = 1;

    foreach ($data as $row) {

        $dusun = '-';
        $rw = '-';
        $rt = '-';

        // 🔥 ID LEVEL
        $id_dusun = null;
        $id_rw = null;
        $id_rt = null;

        // ================= RT =================
        if ($row['jenis'] === 'rt') {

            $rt = $row['nama_wilayah'];
            $id_rt = $row['id_wilayah'];

            if (!empty($row['parent_id']) && isset($map[$row['parent_id']])) {

                $rwData = $map[$row['parent_id']];
                $rw = $rwData['nama_wilayah'];
                $id_rw = $rwData['id_wilayah'];

                if (!empty($rwData['parent_id']) && isset($map[$rwData['parent_id']])) {
                    $dusunData = $map[$rwData['parent_id']];
                    $dusun = $dusunData['nama_wilayah'];
                    $id_dusun = $dusunData['id_wilayah'];
                }
            }

            // 🔥 Filter Dusun untuk level RT
            if (!empty($filterDusun) && $id_dusun != $filterDusun) {
                continue; // Lewati jika tidak sesuai dusun yang dipilih
            }

            $result[] = [
                'no' => $no++,
                'id_dusun' => $id_dusun,
                'id_rw' => $id_rw,
                'id_rt' => $id_rt,
                'dusun' => $dusun,
                'rw' => $rw,
                'rt' => $rt
            ];
        }

        // ================= RW =================
        elseif ($row['jenis'] === 'rw' && !isset($hasChild[$row['id_wilayah']])) {

            $rw = $row['nama_wilayah'];
            $id_rw = $row['id_wilayah'];

            if (!empty($row['parent_id']) && isset($map[$row['parent_id']])) {
                $dusunData = $map[$row['parent_id']];
                $dusun = $dusunData['nama_wilayah'];
                $id_dusun = $dusunData['id_wilayah'];
            }

            // 🔥 Filter Dusun untuk level RW (yang tidak punya RT)
            if (!empty($filterDusun) && $id_dusun != $filterDusun) {
                continue; // Lewati jika tidak sesuai dusun yang dipilih
            }

            $result[] = [
                'no' => $no++,
                'id_dusun' => $id_dusun,
                'id_rw' => $id_rw,
                'id_rt' => null,
                'dusun' => $dusun,
                'rw' => $rw,
                'rt' => '-'
            ];
        }

        // ================= DUSUN =================
        elseif ($row['jenis'] === 'dusun' && !isset($hasChild[$row['id_wilayah']])) {

            $dusun = $row['nama_wilayah'];
            $id_dusun = $row['id_wilayah'];

            // 🔥 Filter Dusun untuk level Dusun itu sendiri (Dusun kosong tanpa RW/RT)
            if (!empty($filterDusun) && $id_dusun != $filterDusun) {
                continue; // Lewati jika tidak sesuai dusun yang dipilih
            }

            $result[] = [
                'no' => $no++,
                'id_dusun' => $id_dusun,
                'id_rw' => null,
                'id_rt' => null,
                'dusun' => $dusun,
                'rw' => '-',
                'rt' => '-'
            ];
        }
    }

    return $this->response->setJSON([
        "data" => array_values($result)
    ]);
}
    // kontroller
public function getParent($jenis)
{
    $result = [];

    if ($jenis === 'rw') {
        $data = $this->model->where('jenis', 'dusun')->findAll();

        foreach ($data as $d) {
            $result[] = [
                'id' => $d['id_wilayah'],
                'nama' => $d['nama_wilayah']
            ];
        }
    }

    elseif ($jenis === 'rt') {
        $rw = $this->model->where('jenis', 'rw')->findAll();
        $all = $this->model->findAll();

        $map = [];
        foreach ($all as $d) {
            $map[$d['id_wilayah']] = $d;
        }

        foreach ($rw as $r) {
            $dusun = '-';

            if (!empty($r['parent_id']) && isset($map[$r['parent_id']])) {
                $dusun = $map[$r['parent_id']]['nama_wilayah'];
            }

            $result[] = [
                'id' => $r['id_wilayah'],
                'nama' => $dusun . ' - ' . $r['nama_wilayah']
            ];
        }
    }

    return $this->response->setJSON($result);
}

public function updateWil()
{
    try {

        $id    = $this->request->getPost('id');
        $field = $this->request->getPost('field');
        $value = $this->request->getPost('value');

        // validasi field (biar aman)
        $allowed = ['nama_wilayah'];

        if (!in_array($field, $allowed)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Field tidak diizinkan'
            ]);
        }

        $model = new \App\Models\WilayahModel();

        $model->update($id, [
            $field => $value
        ]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data berhasil diupdate'
        ]);

    } catch (\Throwable $e) {

        return $this->response->setJSON([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
}

public function save()
{
    $nama  = $this->request->getPost('nama');
    $nama_dusun  = $this->request->getPost('nama_dusun');
    $nama_rw  = $this->request->getPost('nama_rw');
    $nama_rt  = $this->request->getPost('nama_rt');
    $jenis = $this->request->getPost('jenis');
    $parent = $this->request->getPost('parent_id');


    // 🔥 LOGIKA UTAMA
    if ($jenis === 'dusun') {
        $parent_id = null;
        $dusun_id = $this->model->insert([
            'nama_wilayah' => $nama_dusun,
            'jenis' => 'dusun',
            'parent_id' => null
        ], true);

        $rw_id = $this->model->insert([
            'nama_wilayah' => $nama_rw,
            'jenis' => 'rw',
            'parent_id' => $dusun_id
        ], true);

        $this->model->insert([
            'nama_wilayah' => $nama_rt,
            'jenis' => 'rt',
            'parent_id' => $rw_id
        ]);
    } elseif ($jenis === 'rw') {
        $parent_id = $parent ?: null;
        $data = [
            'nama_wilayah' => $nama,
            'jenis' => $jenis,
            'parent_id' => $parent_id
        ];

        $this->model->insert($data);
    } elseif ($jenis === 'rt') {
        $parent_id = $parent ?: null;
        $data = [
            'nama_wilayah' => $nama,
            'jenis' => $jenis,
            'parent_id' => $parent_id
        ];

        $this->model->insert($data);
    } else {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Jenis tidak valid'
        ]);
    }

    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'Data Wilayah berhasil disimpan'
    ]);
}


public function import()
{
    $db = \Config\Database::connect();
    $model = new WilayahModel();

    try {

        $file = $this->request->getFile('file');

        if (!$file || !$file->isValid()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'File tidak valid'
            ]);
        }

        $spreadsheet = IOFactory::load($file->getTempName());
        $rows = $spreadsheet->getActiveSheet()->toArray();

        if (count($rows) <= 1) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'File kosong'
            ]);
        }

        $normalize = function ($text) {
            return strtolower(trim(preg_replace('/\s+/', ' ', $text)));
        };

        $data = [];

        // =========================
        // STEP 1 : Baca Excel
        // =========================
        foreach ($rows as $i => $row) {

            if ($i == 0) continue;

            $nama   = $normalize($row[0] ?? '');
            $jenis  = $normalize($row[1] ?? '');
            $parent = $normalize($row[2] ?? '');

            if ($nama == '' || $jenis == '') {
                continue;
            }

            if (!in_array($jenis, ['dusun', 'rw', 'rt'])) {
                continue;
            }

            $data[] = [
                'nama'   => $nama,
                'jenis'  => $jenis,
                'parent' => $parent
            ];
        }

        // =========================
        // STEP 2 : Urutkan
        // Dusun -> RW -> RT
        // =========================
        usort($data, function ($a, $b) {

            $order = [
                'dusun' => 1,
                'rw'    => 2,
                'rt'    => 3
            ];

            return $order[$a['jenis']] <=> $order[$b['jenis']];
        });

        // =========================
        // STEP 3 : Validasi Dusun
        // =========================
        foreach ($data as $row) {

            if ($row['jenis'] == 'rw') {

                $dusun = $model
                ->where('LOWER(nama_wilayah)', $row['parent'])
                ->where('jenis', 'dusun')
                ->first();

                if (!$dusun) {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => "Import dibatalkan. Dusun '{$row['parent']}' tidak ditemukan di database."
                    ]);
                }
            }
        }

        $db->transBegin();

// mapping nama -> id
        $mapping = [];
        $berhasil = 0;
        $dilewati = 0;

        foreach ($data as $row) {

            $parentId = null;

    /*
    |--------------------------------------------------------------------------
    | DUSUN
    |--------------------------------------------------------------------------
    */
    if ($row['jenis'] == 'dusun') {

        // cek apakah dusun sudah ada
        $exist = $model
        ->where('LOWER(nama_wilayah)', $row['nama'])
        ->where('jenis', 'dusun')
        ->first();

        if ($exist) {

            // simpan id untuk parent RW
            $mapping[$row['nama']] = $exist['id_wilayah'];
            $dilewati++;
            continue;
        }

        $model->insert([
            'nama_wilayah' => $row['nama'],
            'jenis'        => 'dusun',
            'parent_id'    => null
        ]);

        $insertId = $model->getInsertID();

        $mapping[$row['nama']] = $insertId;
        $berhasil++;
    }

    /*
    |--------------------------------------------------------------------------
    | RW
    |--------------------------------------------------------------------------
    */
    elseif ($row['jenis'] == 'rw') {

        $dusun = $model
        ->where('LOWER(nama_wilayah)', $row['parent'])
        ->where('jenis', 'dusun')
        ->first();

        $parentId = $dusun['id_wilayah'];

        // cek apakah RW sudah ada pada dusun tersebut
        $exist = $model
        ->where('LOWER(nama_wilayah)', $row['nama'])
        ->where('jenis', 'rw')
        ->where('parent_id', $parentId)
        ->first();

        if ($exist) {

            $mapping[$row['nama']] = $exist['id_wilayah'];
            $dilewati++;
            continue;
        }

        $model->insert([
            'nama_wilayah' => $row['nama'],
            'jenis'        => 'rw',
            'parent_id'    => $parentId
        ]);

        $insertId = $model->getInsertID();

        $mapping[$row['nama']] = $insertId;
        $berhasil++;
    }

    /*
    |--------------------------------------------------------------------------
    | RT
    |--------------------------------------------------------------------------
    */
    elseif ($row['jenis'] == 'rt') {

        if (!isset($mapping[$row['parent']])) {
            throw new \Exception(
                "RW '{$row['parent']}' tidak ditemukan."
            );
        }

        $parentId = $mapping[$row['parent']];

        // cek apakah RT sudah ada pada RW tersebut
        $exist = $model
        ->where('LOWER(nama_wilayah)', $row['nama'])
        ->where('jenis', 'rt')
        ->where('parent_id', $parentId)
        ->first();

        if ($exist) {
            $dilewati++;
            continue;
        }

        $model->insert([
            'nama_wilayah' => $row['nama'],
            'jenis'        => 'rt',
            'parent_id'    => $parentId
        ]);

        $berhasil++;
    }
}

if ($db->transStatus() === false) {
    $db->transRollback();

    return $this->response->setJSON([
        'status' => 'error',
        'message' => 'Import gagal.'
    ]);
}

$db->transCommit();

return $this->response->setJSON([
    'status' => 'success',
    'message' => "Import selesai. Berhasil ditambahkan {$berhasil} data, dilewati {$dilewati} data karena sudah ada."
]);

} catch (\Throwable $e) {

    if ($db->transStatus()) {
        $db->transRollback();
    }

    return $this->response->setJSON([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
}

public function getDusun()
{
    return $this->response->setJSON(
        $this->model->where('jenis', 'dusun')->findAll()
    );
}

public function getRW($id_dusun)
{
    return $this->response->setJSON(
        $this->model->where('parent_id', $id_dusun)
        ->where('jenis', 'rw')
        ->findAll()
    );
}

public function getRT($id_rw)
{
    return $this->response->setJSON(
        $this->model->where('parent_id', $id_rw)
        ->where('jenis', 'rt')
        ->findAll()
    );
}

public function delete($id)
{
    $cek = $this->model->find($id);

    if (!$cek) {
        return $this->response->setJSON([
            'status' => false,
            'message' => 'Data tidak ditemukan.'
        ]);
    }

    $this->model->delete($id);

    return $this->response->setJSON([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}
}