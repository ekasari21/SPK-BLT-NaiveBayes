<?php

namespace App\Controllers;

use App\Models\DetailAnggotaModel;
use App\Models\KeluargaModel;
use App\Models\PekerjaanModel; 

class DetailAnggota extends BaseController
{
    protected $model;
    protected $keluargaModel;

    public function __construct()
    {
        $this->keluargaModel = new KeluargaModel();
        $this->model = new DetailAnggotaModel();
        $this->modelPekerjaan = new PekerjaanModel();
    }

    public function index()
    {
        // ambil data keluarga
         $data = [
        'pekerjaan' => $this->modelPekerjaan->ambilDataPekerjaan(),
        'pendidikan' => $this->model->getEnumPendidikan(),
        'jenisKelamin' => $this->model->getEnumJenisKelamin(),
        'hubungan'=>$this->model->getEnumHubungan()
    ];
        return view('penduduk/penduduk_view',$data);
    }

    public function getData()
    {
       $no_kk = $this->request->getGet('no_kk');
       if (!empty($no_kk)) {
        // tampilkan anggota berdasarkan nomor KK
        $data = $this->model->getByNoKK($no_kk);
    } else {
        // tampilkan seluruh data
        $data = $this->model->getDatatables();
    }

    $result = [];
    $no = 1;

    foreach ($data as $row) {
        $result[] = [
            "no" => $no++,
            "no_kk" => $row['no_kk'],
            "id_anggota" => $row['id_anggota'],
            "nik" => $row['nik'],
            "nama" => $row['nama'],
            "jenis_kelamin" => $row['jenis_kelamin'],
            "tanggal_lahir" => $row['tanggal_lahir'],
            "hubungan_keluarga" => $row['hubungan_keluarga'],
            "nama_pekerjaan" => $row['nama_pekerjaan'],
            "pendidikan" => $row['pendidikan'],
            "penghasilan_pribadi" => $row['penghasilan_pribadi']
        ];
    }

    return $this->response->setJSON([
        "data" => $result
    ]);
}


public function cekKK()
{
    if (!$this->request->isAJAX()) {
        return $this->response->setStatusCode(404);
    }
    $no_kk = trim($this->request->getPost('no_kk'));
    // Validasi input
    if (empty($no_kk)) {
        return $this->response->setJSON([
            'status'  => false,
            'message' => 'Nomor KK harus diisi.'
        ]);
    }
        // Ambil data keluarga induk
    $keluargainduk = $this->keluargaModel
    ->where('no_kk', $no_kk)
    ->findAll();
    // Ambil data keluarga
    $keluarga = $this->keluargaModel->detailKKbyID($no_kk);
        // Ambil data Kepala Keluarga
    $kepalaKeluarga = $this->keluargaModel->getKepalaKeluarga($no_kk);
    if ($keluarga and $kepalaKeluarga) {
        return $this->response->setJSON([
            'status' => true,
            'keluarga'   => $keluarga,
            'kepala' => $kepalaKeluarga,
            'keluargainduk'=>$keluargainduk
        ]);
    } elseif($keluarga and !$kepalaKeluarga){
        return $this->response->setJSON([
            'status' => true,
            'keluarga'   => $keluarga,
            'kepala' => '-',
            'keluargainduk'=>$keluargainduk
        ]);
    }else {
        return $this->response->setJSON([
            'status'  => false,
            'message' => 'Nomor KK tidak ditemukan.'
        ]);
    }
}


public function simpanKepalaKeluarga()
{
    $id_kk = $this->request->getPost('id_kk');

        // INSERT
    $this->model->insert([

        'id_kk'                => $id_kk,
        'nik'                  => $this->request->getPost('nik'),
        'nama'                 => $this->request->getPost('nama'),
        'jenis_kelamin'        => $this->request->getPost('jenis_kelamin'),
        'tanggal_lahir'        => $this->request->getPost('tgl_lahir'),
        'hubungan_keluarga'    => 'Kepala Keluarga',
        'id_pekerjaan'         => $this->request->getPost('pekerjaan_kepala'),
        'penghasilan_pribadi'  => $this->request->getPost('penghasilan'),
        'pendidikan'           => $this->request->getPost('pendidikan')

    ]); 


    return $this->response->setJSON([
        'status'  => 'success',
        'message' => 'Data Kepala Keluarga berhasil disimpan.'
    ]);
}

public function simpanAnggotaKeluarga()
{
            // INSERT
   $this->model->insert([

    'id_kk'                => $this->request->getPost('id_kk'),
    'nik'                  => $this->request->getPost('nik'),
    'nama'                 => $this->request->getPost('nama'),
    'jenis_kelamin'        => $this->request->getPost('jenis_kelamin'),
    'tanggal_lahir'        => $this->request->getPost('tgl_lahir'),
    'hubungan_keluarga'    => $this->request->getPost('hubungan_keluarga'),
    'id_pekerjaan'         => $this->request->getPost('pekerjaan'),
    'penghasilan_pribadi'  => $this->request->getPost('penghasilan'),
    'pendidikan'           => $this->request->getPost('pendidikan')

]);

   return redirect()
   ->to(base_url('tambahanggota?no_kk='.$this->request->getPost('no_kk')))
   ->with('success','Data anggota keluarga berhasil disimpan.'); 
}
public function edit($id)
{
    $data = $this->model->find($id);

    if(!$data){

        return $this->response->setJSON([
            'status'=>false,
            'message'=>'Data tidak ditemukan.'
        ]);

    }

    return $this->response->setJSON([
        'status'=>true,
        'data'=>$data
    ]);
}

public function update()
{
    if (!$this->request->isAJAX()) {
        return $this->response->setStatusCode(404);
    }

    $id = $this->request->getPost('id_anggota');

    // Cek data
    $anggota = $this->model->find($id);

    if (!$anggota) {
        return $this->response->setJSON([
            'status'  => false,
            'message' => 'Data anggota tidak ditemukan.'
        ]);
    }

    // Validasi
    $rules = [
        'nik'                => 'required|min_length[16]|max_length[16]',
        'nama'               => 'required',
        'jenis_kelamin'      => 'required',
        'tanggal_lahir'      => 'required',
        'hubungan_keluarga'  => 'required',
        'pendidikan'         => 'required',
        'id_pekerjaan'       => 'required',
        'penghasilan'        => 'required'
    ];

    if (!$this->validate($rules)) {
        return $this->response->setJSON([
            'status'  => false,
            'message' => implode('<br>', $this->validator->getErrors())
        ]);
    }

    // Hilangkan format rupiah
    $penghasilan = str_replace('.', '', $this->request->getPost('penghasilan'));

    $data = [
        'nik'                => trim($this->request->getPost('nik')),
        'nama'               => trim($this->request->getPost('nama')),
        'jenis_kelamin'      => $this->request->getPost('jenis_kelamin'),
        'tanggal_lahir'      => $this->request->getPost('tanggal_lahir'),
        'hubungan_keluarga'  => $this->request->getPost('hubungan_keluarga'),
        'pendidikan'         => $this->request->getPost('pendidikan'),
        'id_pekerjaan'       => $this->request->getPost('id_pekerjaan'),
        'penghasilan'        => $penghasilan
    ];

    try {

        $this->model->update($id, $data);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Data anggota keluarga berhasil diperbarui.'
        ]);

    } catch (\Exception $e) {

        return $this->response->setJSON([
            'status'  => false,
            'message' => $e->getMessage()
        ]);

    }
}
public function hapusAnggota($id)
{
    if (!$this->request->isAJAX()) {
        return $this->response->setStatusCode(404);
    }

    $anggota = $this->model->find($id);

    if (!$anggota) {

        return $this->response->setJSON([
            'status' => false,
            'message' => 'Data anggota keluarga tidak ditemukan.'
        ]);

    }

    try {

        $this->model->delete($id);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Data anggota keluarga berhasil dihapus.'
        ]);

    } catch (\Exception $e) {

        return $this->response->setJSON([
            'status' => false,
            'message' => $e->getMessage()
        ]);

    }

}

}