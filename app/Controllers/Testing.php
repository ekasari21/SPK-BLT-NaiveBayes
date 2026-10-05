<?php

namespace App\Controllers;

use App\Models\TrainingModel;
use App\Models\KriteriaModel;
use App\Models\NilaiKriteriaModel;
use App\Models\KeluargaModel; 
use App\Models\DetailAnggotaModel;
use App\Models\HasilPrediksiModel;
use App\Models\PersetujuanModel;

use Dompdf\Dompdf;
use Dompdf\Options;


class Testing extends BaseController
{
	protected $TrainingModel;
	protected $KriteriaModel;
	protected $modelNilaiKriteria;
	protected $keluargaModel;
	protected $DetailAnggotaModel;
	protected $HasilPrediksiModel;
	protected $PersetujuanModel;

	public function __construct()
	{
		$this->TrainingModel = new TrainingModel();
		$this->KriteriaModel = new KriteriaModel();
		$this->modelNilaiKriteria = new NilaiKriteriaModel();
		$this->keluargaModel = new KeluargaModel();
		$this->DetailAnggotaModel = new DetailAnggotaModel();
		$this->HasilPrediksiModel = new HasilPrediksiModel();
		$this->PersetujuanModel = new PersetujuanModel();
	}
	public function index()
	{
		$jmlTesting = $this->TrainingModel->jmlTesting();
		$jmlNotSetTesting = $this->TrainingModel->jmlNotSetTesting();
		$jmlSudahSetTesting= $this->TrainingModel->jmlSudahSetTesting();
		$data = [
			'jmlTesting'  =>  $jmlTesting,
			'jmlNotSetTesting' => $jmlNotSetTesting,
			'jmlSudahSetTesting'=> $jmlSudahSetTesting
		];
		return view('klasifikasi/calonKlasifikasi_view',$data);
		
	}
	public function getDataKlasifikasi()
	{
		$rows = $this->TrainingModel->getDataKlasifikasi();
		

		$data = [];

		foreach ($rows as $row) {

			$id = $row['id_kk'];

			if (!isset($data[$id])) {

            // Membentuk daftar kriteria
				$kriteria = [];

				$kolom = [
					'kepemilikan_kendaraan' => 'Kepemilikan Kendaraan',
					'kepemilikan_rumah'     => 'Kepemilikan Rumah',
					'kondisi_rumah'         => 'Kondisi Rumah',
					'kepemilikan_tanah'     => 'Kepemilikan Tanah',
					'penghasilan'           => 'Penghasilan',
					'tanggungan'            => 'Tanggungan',
					'usia'                  => 'Usia',
					'pekerjaan'             => 'Pekerjaan'
				];

				foreach ($kolom as $field => $label) {

					if (!empty($row[$field])) {
						$kriteria[] = $label . ' : ' . $row[$field];
					}
				}
				if(empty($kriteria)){
					$status='Belum Set Kriteria';
				}else{
					$status="Sudah Set Kriteria";
				}

				$data[$id] = [
					'id_dataset'       => $row['id_dataset'],
					'id_kk'            => $row['id_kk'],
					'no_kk'            => $row['no_kk'],
					'jumlah_anggota'   => $row['jumlah_anggota'],
					'alamat'           => $row['alamat'],
					'kepala_keluarga'  => '',
					'anggota'          => [],
					'status'		   => $status,
					'label_aktual'		=> $row['label_aktual'],
					'kriteria'         => empty($kriteria) ? '-' : implode('<br>', $kriteria)
				];
			}

			if ($row['hubungan_keluarga'] == 'Kepala Keluarga') {
				$data[$id]['kepala_keluarga'] = $row['nama'];
			} else {
				$data[$id]['anggota'][] = $row['nama'];
			}
		}

		return $this->response->setJSON([
			'data' => array_values($data)
		]);
	}

	public function tambahCalonKlasifikasi()
	{


		return view('klasifikasi/tambahCalonKlasifikasi_view.php');


	}
	public function getCalonKlasifikasi()
	{
		$keyword = $this->request->getGet('keyword');

		$data = $this->keluargaModel->getDataCalonTraining($keyword);

		return $this->response->setJSON([
			"data" => $data
		]);
	}

	public function simpanKlasifikasi()
	{
		$idKK  = $this->request->getPost('id_kk');

		if (empty($idKK)) {
			return $this->response->setJSON([
				'status'  => false,
				'message' => 'Pilih minimal satu data.'
			]);
		}

		foreach ($idKK as $id) {

        // Cek agar tidak ada data ganda
			$cek = $this->TrainingModel
			->where('id_kk', $id)
			->first();

			if (!$cek) {

				$this->TrainingModel->insert([
					'id_kk'        => $id,
					'status'       => 'Testing'
				]);

			}
		}

		return $this->response->setJSON([
			'status'  => true,
			'message' => 'Calon Klasifikasi berhasil disimpan.'
		]);
	}

	public function tambahKriteriaKlasifikasi()
	{
		$id_kk = $this->request->getGet('id_kk');
		$keluarga= $this->keluargaModel->cekKeluargaByIDKlasifikasi($id_kk);
		$anggotaKeluarga=$this->DetailAnggotaModel-> getAnggotaKeluargaByIdKK($id_kk);
		$valueKriteria=$this->TrainingModel->cekValueKriteriaByDataset($id_kk);

		$kriteria = $this->KriteriaModel->getKriteria();
		foreach ($kriteria as &$k) {

			$k['nilai'] = $this->modelNilaiKriteria->getNilaiByKriteria($k['id_kriteria']);

		}


		$data = [
			'keluarga'=> $keluarga,
			'anggotaKeluarga'=>$anggotaKeluarga,
			'kriteria'=>$kriteria,
			'valueKriteria'=>$valueKriteria
		];
		if(empty($keluarga)){
			return view('klasifikasi/halaman_NoAkses_Klasifikasi');
		}
		return view('klasifikasi/tambah_kriteria_klasifikasi',$data);


	}
	public function simpanSetKriteriaKlasifikasi()
	{
		$idKK = $this->request->getPost('id_kk');

		$this->TrainingModel
		->where('id_kk', $idKK)
		->set('kepemilikan_kendaraan', $this->request->getPost('C1'))
		->set('kepemilikan_rumah', $this->request->getPost('C2'))
		->set('kondisi_rumah', $this->request->getPost('C3'))
		->set('kepemilikan_tanah', $this->request->getPost('C4'))
		->set('penghasilan', $this->request->getPost('C5'))
		->set('tanggungan', $this->request->getPost('C6'))
		->set('usia', $this->request->getPost('C7'))
		->set('pekerjaan', $this->request->getPost('C8'))
		->update();

		return redirect()
		->to(base_url('calonKlasifikasi'))
		->with('success', 'Data Klasifikasi berhasil diset. '); 
	}
	public function hasilKlasifikasi()
	{
		$jmlKlasifikasiLayak = $this->HasilPrediksiModel->jmlKlasifikasiLayak();
		$jmlKlasifiasiTidakLayak= $this->HasilPrediksiModel->jmlKlasifikasiTidakLayak();
		
		$data = [
			'jmlKlasifikasiLayak'  =>  $jmlKlasifikasiLayak,
			'jmlKlasifiasiTidakLayak'=> $jmlKlasifiasiTidakLayak
		];

		return view('klasifikasi/hasil_klasifikasi',$data);
	}

	public function HitungHasilKlasifikasi()
	{
		try {

			$hasil = $this->TrainingModel->hitungPosteriorTesting();

			foreach ($hasil as $row) {

            // Hapus hasil lama jika sudah ada
				$this->HasilPrediksiModel
				->where('id_dataset', $row['id_dataset'])
				->delete();

            // Simpan hasil baru
				$this->HasilPrediksiModel->insert([
					'id_dataset'                  => $row['id_dataset'],
					'probabilitas_layak'          => $row['posterior_layak'],
					'probabilitas_tidak_layak'    => $row['posterior_tidak_layak'],
					'hasil'                       => $row['hasil'],
					'tanggal_status'              => date('Y-m-d')
				]);
			}

			return $this->response->setJSON([
				'status'  => true,
				'message' => 'Perhitungan klasifikasi Naive Bayes berhasil dilakukan.'
			]);

		} catch (\Exception $e) {

			return $this->response->setJSON([
				'status'  => false,
				'message' => $e->getMessage()
			]);
		}
	}
	
	public function getDataHasilKlasifikasi()
	{
		$rows = $this->HasilPrediksiModel->getDataHasilKlasifikasi();

		$data = [];

		foreach ($rows as $row) {

			$id = $row['id_kk'];

			if (!isset($data[$id])) {

            // Membentuk daftar kriteria
				$kriteria = [];

				$kolom = [
					'kepemilikan_kendaraan' => 'Kepemilikan Kendaraan',
					'kepemilikan_rumah'     => 'Kepemilikan Rumah',
					'kondisi_rumah'         => 'Kondisi Rumah',
					'kepemilikan_tanah'     => 'Kepemilikan Tanah',
					'penghasilan'           => 'Penghasilan',
					'tanggungan'            => 'Tanggungan',
					'usia'                  => 'Usia',
					'pekerjaan'             => 'Pekerjaan'
				];

				foreach ($kolom as $field => $label) {

					if (!empty($row[$field])) {
						$kriteria[] = $label . ' : ' . $row[$field];
					}
				}
				

				$data[$id] = [
					'id_hasil'			=>$row['id_hasil'],
					'id_dataset'       => $row['id_dataset'],
					'id_kk'            => $row['id_kk'],
					'no_kk'            => $row['no_kk'],
					'kriteria'         => empty($kriteria) ? '-' : implode('<br>', $kriteria),
					'kepala_keluarga'   => $row['kepala_keluarga'],
					'probabilitas_layak'         => $row['probabilitas_layak'],
					'probabilitas_tidak_layak' => $row['probabilitas_tidak_layak'],
					'hasil'		=> $row['hasil'],
					"persetujuan" => $this->PersetujuanModel->getHasilPersetujuan($row['id_hasil'])

				];
			}

			
		}

		return $this->response->setJSON([
			'data' => array_values($data)
		]);

	}
	public function hapusHasilPrediksi()
	{
		$id = $this->request->getPost('id_hasil');

		$cek = $this->HasilPrediksiModel->find($id);

		if (!$cek) {
			return $this->response->setJSON([
				'status' => false,
				'message' => 'Data tidak ditemukan.'
			]);
		}

		$this->HasilPrediksiModel->delete($id);

		return $this->response->setJSON([
			'status' => true,
			'message' => 'Data Hasil klasifikasi berhasil dihapus.'
		]);
	}
	public function resetHasilKlasifikasi()
	{
		$this->HasilPrediksiModel->resetKlasifikasi();

		return $this->response->setJSON([
			'status'  => true,
			'message' => 'Seluruh hasil klasifikasi berhasil dihapus.'
		]);
	}
	public function setujui()
	{

		if (!$this->request->isAJAX()) {
			return;
		}

		$id_hasil = $this->request->getPost('id_hasil');

        // Cek apakah sudah pernah diproses
		$cek = $this->PersetujuanModel->where('id_hasil', $id_hasil)->first();

		$data = [

			'id_hasil'        => $id_hasil,
			'id_user'         => session()->get('id_user'),
			'status'          => 'Disetujui',
			'catatan'         => null,
			'tgl_persetujuan' => date('Y-m-d')

		];
		if($cek){
			$this->PersetujuanModel->update($cek['id_persetujuan'], [
				'status' => 'Disetujui',
				'catatan' => "Disetujui ulang",
				'id_user' => session()->get('id_user'),
				'tgl_persetujuan' => date('Y-m-d')
			]);

			return $this->response->setJSON([
				'status' => true,
				'message' => 'Data berhasil Disetujui Ulang'
			]);

		}else{


			$this->PersetujuanModel->insert($data);

			return $this->response->setJSON([
				'status' => true,
				'message' => 'Persetujuan berhasil disimpan.'
			]);
		}

	}

	public function tolak()
	{
		if (!$this->request->isAJAX()) {
			return;
		}

		$id_hasil = $this->request->getPost('id_hasil');
		$catatan  = $this->request->getPost('catatan');

		

    // Cek apakah sudah diproses
		$cek = $this->PersetujuanModel->where('id_hasil', $id_hasil)->first();

		$data = [
			'id_hasil'         => $id_hasil,
			'id_user'          => session()->get('id_user'),
			'status'           => 'Ditolak',
			'catatan'          => $catatan,
			'tgl_persetujuan'  => date('Y-m-d')
		];
		if($cek){
			$this->PersetujuanModel->update($cek['id_persetujuan'], [
				'status' => 'Ditolak',
				'catatan' => $catatan,
				'id_user' => session()->get('id_user'),
				'tgl_persetujuan' => date('Y-m-d')
			]);

			return $this->response->setJSON([
				'status' => true,
				'message' => 'Data sudah berhasil Ditolak ulang.'
			]);

		}else{
			$this->PersetujuanModel->insert($data);

			return $this->response->setJSON([
				'status' => true,
				'message' => 'Penolakan berhasil disimpan.'
			]);

		}

	}


	public function penerimaBantuan()
	{
		$jmlDisetujui = $this->PersetujuanModel->jmlDisetujui();
		$jmlDitolak= $this->PersetujuanModel->jmlDitolak();
		
		$data = [
			'jmlDisetujui'  =>  $jmlDisetujui,
			'jmlDitolak'=> $jmlDitolak
		];

		return view('klasifikasi/penerimaBantuan',$data);
	}
	public function getHasilPresetujuan()
	{
		$tglAwal  = $this->request->getGet('tgl_awal');
		$tglAkhir = $this->request->getGet('tgl_akhir');
		$status   = $this->request->getGet('status');

		$rows = $this->PersetujuanModel->getDataHasilPersetujuan($tglAwal, $tglAkhir, $status);

		$data = [];

		foreach ($rows as $row) {

			$id = $row['id_kk'];

			if (!isset($data[$id])) {

            // Membentuk daftar kriteria
				$kriteria = [];

				$kolom = [
					'kepemilikan_kendaraan' => 'Kepemilikan Kendaraan',
					'kepemilikan_rumah'     => 'Kepemilikan Rumah',
					'kondisi_rumah'         => 'Kondisi Rumah',
					'kepemilikan_tanah'     => 'Kepemilikan Tanah',
					'penghasilan'           => 'Penghasilan',
					'tanggungan'            => 'Tanggungan',
					'usia'                  => 'Usia',
					'pekerjaan'             => 'Pekerjaan'
				];

				foreach ($kolom as $field => $label) {

					if (!empty($row[$field])) {
						$kriteria[] = $label . ' : ' . $row[$field];
					}
				}
				

				$data[$id] = [
					'id_hasil'			=>$row['id_hasil'],
					'id_dataset'       => $row['id_dataset'],
					'id_kk'            => $row['id_kk'],
					'no_kk'            => $row['no_kk'],
					'kriteria'         => empty($kriteria) ? '-' : implode('<br>', $kriteria),
					'kepala_keluarga'   => $row['kepala_keluarga'],
					'status'         => $row['hasil_persetujuan'],
					'tgl_persetujuan' => $row['tgl_persetujuan'],
					'catatan'			=> $row['catatan']
				];
			}

			
		}

		return $this->response->setJSON([
			'data' => array_values($data)
		]);

	}
	
	public function downloadHasilPersetujuan()
	{
		$tglAwal  = $this->request->getGet('tgl_awal');
		$tglAkhir = $this->request->getGet('tgl_akhir');
		$status   = $this->request->getGet('status');

		$data['hasil'] = $this->PersetujuanModel
		->getDataHasilPersetujuan($tglAwal, $tglAkhir, $status);

		$data['tglAwal']  = $tglAwal;
		$data['tglAkhir'] = $tglAkhir;
		$data['status']   = $status;

		$html = view('laporan/laporan_persetujuan', $data);

		$options = new Options();
		$options->set('isRemoteEnabled', true);

		$dompdf = new Dompdf($options);

		$dompdf->loadHtml($html);

		$dompdf->setPaper('A4', 'landscape');

		$dompdf->render();

		$dompdf->stream(
			'Laporan_Persetujuan_Bantuan.pdf',
        ['Attachment' => false] // tampil di tab baru
    );

		exit;
	}

	
	public function halamanSetujuiMasal()
	{
		
		return view('klasifikasi/halamanSetujuiMasal');
	}

	public function getDataPersetujuan()
	{
		$data = $this->PersetujuanModel->getDataCalonPersetujuan();

		foreach ($data as &$row) {

			$anggota = $this->DetailAnggotaModel
			->where('id_kk', $row['id_kk'])
			->findAll();

			$nama = [];

			foreach ($anggota as $a) {
				$nama[] = $a['nama'] . ' (' . $a['hubungan_keluarga'] . ')';
			}

			$row['anggota_keluarga'] = implode('<br>', $nama);
		}

		return $this->response->setJSON([
			'data' => $data
		]);
	}


	public function setujuiMasal()
	{
		$idHasil = $this->request->getPost('id_hasil');

		if(empty($idHasil)){

			return $this->response->setJSON([
				'status'=>false,
				'message'=>'Tidak ada data dipilih.'
			]);

		}
		foreach($idHasil as $id){

			$cek = $this->PersetujuanModel
			->where('id_hasil',$id)
			->first();

			if(!$cek){

				$this->PersetujuanModel->insert([

					'id_hasil'=>$id,
					'id_user'=>session()->get('id_user'),
					'status'=>'Disetujui',
					'catatan'=>'Disetujui tanpa catatan',
					'tgl_persetujuan'=>date('Y-m-d')

				]);

			}

		}



		return $this->response->setJSON([

			'status'=> true,
			'message'=>'Persetujuan massal berhasil diproses.'

		]);

	}
	
}