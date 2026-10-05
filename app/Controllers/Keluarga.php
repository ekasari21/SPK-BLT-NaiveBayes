<?php

namespace App\Controllers;
use App\Models\KeluargaModel;
use App\Models\DetailAnggotaModel;
use App\Models\PekerjaanModel; 

class Keluarga extends BaseController
{
	protected $model;
	protected $modelDetailKK;
	protected $modelPekerjaan;

	public function __construct()
	{
		$this->model = new KeluargaModel();
		$this->modelDetailKK = new DetailAnggotaModel();
		$this->modelPekerjaan = new PekerjaanModel();
	}
	
	public function index()
	{

		return view('penduduk/keluarga_view');
	}
	public function tambahanggota()
	{
		$no_kk = $this->request->getGet('no_kk');
		

    // ambil data keluarga
		$data = [
			'keluarga'  =>  $this->model->detailKKbyID($no_kk),
			'pekerjaan' => $this->modelPekerjaan->ambilDataPekerjaan(),
			'pendidikan' => $this->modelDetailKK->getEnumPendidikan(),
			'jenisKelamin' => $this->modelDetailKK->getEnumJenisKelamin(),
			'anggotaKeluarga' => $this->modelDetailKK->getByNoKK($no_kk),
			'kepala'=>$this->modelDetailKK->getKepalaKeluargaByNik($no_kk),
			'hubungan'=>$this->modelDetailKK->getEnumHubungan()
		];
		return view('penduduk/tambahanggota',$data);
	}
	public function getData()
	{
		$data = $this->model->getDataWithWilayah();

		return $this->response->setJSON([
			'data' => $data
		]);
	}
	public function saveKeluarga()
	{
		$this->model->insert([
			'no_kk' => $this->request->getPost('no_kk'),
			'alamat' => $this->request->getPost('alamat'),
			'id_dusun' => $this->request->getPost('id_dusun'),
			'id_rw' => $this->request->getPost('id_rw'),
			'id_rt' => $this->request->getPost('id_rt'),
			'jumlah_anggota' => $this->request->getPost('jumlah_anggota')
		]);

		$id_kk = $this->model->getInsertID();
		
		return $this->response->setJSON([
			'status' => 'success',
			'message' => 'Data Keluarga berhasil disimpan',
			'id_kk'   => $id_kk,
			'no_kk'   => $this->request->getPost('no_kk')
		]);

	}
	public function getById($id)
	{
		return $this->response->setJSON(
			$this->model->find($id)
		);
	}
	public function updateKeluarga()
	{
		$id = $this->request->getPost('id_kk');

		$this->model->update($id, [
			'no_kk' => $this->request->getPost('no_kk'),
			'kepala_keluarga' => $this->request->getPost('kepala_keluarga'),
			'alamat' => $this->request->getPost('alamat'),
			'id_dusun' => $this->request->getPost('id_dusun'),
			'id_rw' => $this->request->getPost('id_rw'),
			'id_rt' => $this->request->getPost('id_rt'),
			'jumlah_anggota' => $this->request->getPost('jumlah_anggota'),
		]);

		return $this->response->setJSON([
			'status' => 'success',
			'message' => 'Data berhasil diupdate'
		]);
	}
	public function deleteKeluarga()
	{
		try {

			$id = $this->request->getPost('id_kk');

			if (!$id) {
				return $this->response->setJSON([
					'status' => 'error',
					'message' => 'ID tidak ditemukan.'
				]);
			}

			$this->modelDetailKK->deleteDetailKK($id);

			$this->model->delete($id);

			return $this->response->setJSON([
				'status' => 'success',
				'message' => 'Berhasil dihapus.'
			]);

		} catch (\Throwable $e) {

			return $this->response->setJSON([
				'status' => 'error',
				'message' => $e->getMessage(),
				'line' => $e->getLine(),
				'file' => $e->getFile()
			]);

		}
	}
	public function getDetailAnggota()
	{

		$id = $this->request->getGet('id');

		$keluarga = $this->model->find($id);

		$anggota = $this->modelDetailKK->getByKK($id);

		return $this->response->setJSON([

			'keluarga'=>$keluarga,

			'anggota'=>$anggota

		]);

	}
	
}