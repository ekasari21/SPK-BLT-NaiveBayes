<?php

namespace App\Controllers;

use App\Models\PersetujuanModel;

class Home extends BaseController
{

    protected $PersetujuanModel;

    public function __construct()
    {
        $this->PersetujuanModel = new PersetujuanModel();
    }
    public function index(): string
    {
        return view('index');
    }
    public function cekStatus(): string
    {
        return view('publik/cekstatus');
    }
    public function Login(): string
    {
        return view('publik/login');
    }

    public function cekStatusKelayakan()
    {
        if (!$this->request->isAJAX()) {
            return;
        }

        $noKK = $this->request->getPost('no_kk');



        $data = $this->PersetujuanModel->cekStatusKelayakan($noKK);

        if (!$data) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Nomor KK tidak ditemukan.'
            ]);
        }

    // Status klasifikasi
        if (empty($data['hasil'])) {
            $statusKlasifikasi = 'Belum Diproses';
        } else {
        $statusKlasifikasi = $data['hasil']; // Layak / Tidak Layak
    }

    // Status persetujuan
    if (empty($data['id_persetujuan'])) {
        $statusPersetujuan = 'Belum Disetujui';
    } else {
        $statusPersetujuan = $data['status_persetujuan'];
    }

    return $this->response->setJSON([
        'status' => true,
        'data' => [
            'no_kk'                    => $data['no_kk'],
            'hasil'                    => $statusKlasifikasi,
            'label_prediksi'           => $data['label_prediksi'],
            'probabilitas_layak'       => $data['probabilitas_layak'],
            'probabilitas_tidak_layak' => $data['probabilitas_tidak_layak'],
            'status_persetujuan'       => $statusPersetujuan,
            'catatan'                  => $data['catatan']
        ]
    ]);
}
}
