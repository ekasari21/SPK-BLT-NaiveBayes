<?php

namespace App\Controllers;

use App\Models\TrainingModel;
use App\Models\KriteriaModel;
use App\Models\NilaiKriteriaModel;
use App\Models\KeluargaModel;
use App\Models\DetailAnggotaModel;

class Training extends BaseController
{
	protected $TrainingModel;
	protected $KriteriaModel;
	protected $modelNilaiKriteria;
	protected $keluargaModel;
	protected $DetailAnggotaModel;

	public function __construct()
	{
		$this->TrainingModel = new TrainingModel();
		$this->KriteriaModel = new KriteriaModel();
		$this->modelNilaiKriteria = new NilaiKriteriaModel();
		$this->keluargaModel = new KeluargaModel();
		$this->DetailAnggotaModel = new DetailAnggotaModel();
	} 
	public function index()
	{
		$probabilitas =$this->TrainingModel->getProbabilitasKondisional();
		$kriteriaSow=$this->KriteriaModel->getKriteria();
		$probPrior = $this->TrainingModel->hitungPrior();
		$data = [
			'probPrior' 	=> $probPrior,
			'probabilitas' => $probabilitas,
			'kriteriaShow' =>$kriteriaSow
		];

		return view('dataset/training_view',$data);
	}
	public function calonTraining()
	{
		$jmlTraining = $this->TrainingModel->jmlTraining();
		$jmlNotSetTraining = $this->TrainingModel->jmlNotSetTraining();
		$jmlSudahSetTraining= $this->TrainingModel->jmlSudahSetTraining();
		$data = [
			'jmlTraining'  =>  $jmlTraining,
			'jmlNotSetTraining' => $jmlNotSetTraining,
			'jmlSudahSetTraining'=> $jmlSudahSetTraining
		];
		return view('dataset/calonTraining_view',$data);
	}
	public function tambahTraining()
	{
		$id_kk = $this->request->getGet('id_kk');
		$keluarga= $this->keluargaModel->cekKeluargaByIDKK($id_kk);
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
			return view('dataset/halaman_NoAkses_klasifikasi');
		}
		return view('dataset/tambah_training_view',$data);


	}
	
	public function tambahCalonTraining()
	{


		return view('dataset/tambahCalonTraining_view.php');


	}
	public function getCalonTraining()
	{
		$keyword = $this->request->getGet('keyword');

		$data = $this->keluargaModel->getDataCalonTraining($keyword);

		return $this->response->setJSON([
			"data" => $data
		]);
	}

	public function simpanTraining()
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
					'status'       => 'Training'
				]);

			}
		}

		return $this->response->setJSON([
			'status'  => true,
			'message' => 'Data training berhasil disimpan.'
		]);
	}
	public function getDataTraining()
	{
		$rows = $this->TrainingModel->getDataTraining();
		

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

	public function getDataTrainingSetKriteria(){
		$data=$this->TrainingModel->getDataTrainingSetKriteria();


		return $this->response->setJSON([
			'data' => $data
		]);
	}

	public function simpanSetKriteria()
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
		->set('label_aktual', $this->request->getPost('label'))
		->update();

		return redirect()
		->to(base_url('calonTraining'))
		->with('success', 'Data training berhasil disimpan. '); 
	}

}