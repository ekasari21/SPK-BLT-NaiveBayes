<?php

namespace App\Controllers;
use App\Models\KriteriaModel;
use App\Models\NilaiKriteriaModel;

class Kriteria extends BaseController
{
	protected $model;
	protected $modelNilaiKriteria;

    // controller utama
	public function __construct()
	{
		$this->model = new KriteriaModel();
		$this->modelNilaiKriteria = new NilaiKriteriaModel();
	}
	public function index()
	{
		$edit = $this->request->getGet('edit');

		$data['isEditable'] = ($edit === 'on');


		return view('kriteria/kriteria_dash', $data);
	}
	public function nilaiKriteria()
	{
		$edit = $this->request->getGet('edit');

		$data['isEditable'] = ($edit === 'on');


		return view('kriteria/nilaiKriteria', $data);
	}
	/*public function tambahNilaiKriteria()
	{


		return view('kriteria/tambahNilaiKriteria_View');
	} */
	public function tambahNilaiKriteria()
	{
		$data['listKriteria'] = $this->model
		->orderBy('kode_kriteria', 'ASC')
		->findAll();

		$id_kriteria = $this->request->getGet('id_kriteria');

		$data['id_kriteria'] = $id_kriteria;
		$data['kriteria'] = null;
		$data['nilai'] = [];

		if (!empty($id_kriteria)) {

			$data['kriteria'] = $this->model
			->find($id_kriteria);

			$data['nilai'] = $this->model
			->where('id_kriteria', $id_kriteria)
			->findAll();
		}

		return view('kriteria/tambahNilaiKriteria_View',$data);
	}

	public function getDataKriteria()
	{

		$data = $this->model->findAll();

		return $this->response->setJSON($data);
	}
	

	public function getKriteriaById()
	{
		$id = $this->request->getGet('id');

		$data = $this->model->find($id);

		return $this->response->setJSON($data);
	}
	public function updateKriteria()
	{
		$id = $this->request->getPost('id_kriteria');

		$rules = [

			'kode_kriteria' => 'required',

			'nama_kriteria' => 'required',

			'keterangan' => 'required'

		];

		if(!$this->validate($rules)){

			return $this->response->setJSON([

				'status'=>'error',

				'message'=>$this->validator->listErrors()

			]);

		}

		$this->model->update($id,[

			'kode_kriteria'=>$this->request->getPost('kode_kriteria'),

			'nama_kriteria'=>$this->request->getPost('nama_kriteria'),

			'keterangan'=>$this->request->getPost('keterangan')

		]);

		return $this->response->setJSON([

			'status'=>'success',

			'message'=>'Data berhasil diperbarui.'

		]);
	}

	public function insertKriteria()
	{
		$data = [
			'id_kriteria' => null,
			'kode_kriteria' => $this->request->getPost('kode_kriteria'),
			'nama_kriteria' => $this->request->getPost('nama_kriteria'),
			'keterangan' => $this->request->getPost('keterangan'),
		];

		if ($this->model->insert($data)) {
			return $this->response->setJSON([
				'status' => 'success',
				'message' => 'Data berhasil ditambahkan'
			]);
		}

		return $this->response->setJSON([
			'status' => 'error',
			'message' => 'Gagal tambah data'
		]);
	}
	public function deleteKriteria()
	{
		$id = $this->request->getPost('id_kriteria');

		if(!$id){

			return $this->response->setJSON([

				'status'=>'error',

				'message'=>'ID tidak ditemukan.'

			]);

		}

		if($this->model->delete($id)){

			return $this->response->setJSON([

				'status'=>'success',

				'message'=>'Data berhasil dihapus.'

			]);

		}

		return $this->response->setJSON([

			'status'=>'error',

			'message'=>'Data gagal dihapus.'

		]);
	}
	public function getNilaiKriteria()
	{
		$data = $this->modelNilaiKriteria->getData();

		return $this->response->setJSON($data);
	}
	public function getNilaiKriteriabyid()
	{
		$id = $this->request->getGet('id_kriteria');

		$data = $this->modelNilaiKriteria
		->where('id_kriteria', $id)
		->findAll();
		
		$no = 1;

		foreach ($data as &$row) {
			$row['no'] = $no++;
		}

		return $this->response->setJSON([
			'data' => $data
		]);
	}


	public function updateNilaiKriteriaAll()
	{
		try {

			$id    = $this->request->getPost('id');
			$field = $this->request->getPost('field');
			$value = $this->request->getPost('value');

			$modelNilaiKriteria->update($id, [
				$field => $value
			]);

			return $this->response->setJSON([
				'status' => 'success',
				'message' => 'Data Nilai Kriteria berhasil diupdate'
			]);

		} catch (\Throwable $e) {

			return $this->response->setJSON([
				'status' => 'error',
				'message' => $e->getMessage()
			]);
		}
	}

	public function getDetailNilaiKriteria()
	{
		$id = $this->request->getGet('id');

		$data = $this->modelNilaiKriteria->getDatabyId($id);

		return $this->response
		->setJSON($data);
	}
	public function getDetailKriteria()
	{

		$id = $this->request->getGet('id');

		$data= $this->modelNilaiKriteria->getDatabyIdKriteria($id);

		return $this->response->setJSON($data);

	}
	public function updateNilaiKriteria()
	{

		$id = $this->request->getPost('id_nilai');

		$this->modelNilaiKriteria->update($id,[

			'kategori'=>$this->request->getPost('kategori'),

			'nilai'=>$this->request->getPost('nilai'),

			'skor'=>$this->request->getPost('skor'),

			'keterangan'=>$this->request->getPost('keterangan')

		]);

		return $this->response->setJSON([

			'status'=>'success',

			'message'=>'Data berhasil diupdate.'

		]);

	}
	public function simpanNilaiKriteria()
	{
		try{

			$data = [

				'id_kriteria'=>$this->request->getPost('id_kriteria'),

				'kategori'=>$this->request->getPost('kategori'),

				'nilai'=>$this->request->getPost('nilai'),

				'skor'=>$this->request->getPost('skor'),

				'keterangan'=>$this->request->getPost('keterangan')

			];

			$this->modelNilaiKriteria->insert($data);

			return $this->response->setJSON([
				'status'=>'success',
				'message'=>'Berhasil'
			]);

		}catch(\Exception $e){

			return $this->response->setJSON([
				'status'=>'error',
				'message'=>$e->getMessage()
			]);

		}

	}

	public function deleteNilaiKriteria()
	{
		$id = $this->request->getPost('id');
		if ($this->modelNilaiKriteria->delete($id)) {
			return $this->response->setJSON([
				'status' => 'success',
				'message' => 'Data Nilai Kriteria berhasil dihapus'
			]);
		}

		return $this->response->setJSON([
			'status' => 'error',
			'message' => 'Gagal hapus Data Nilai Kriteria'
		]);
	}

	
	public function getNilai($id)
	{
		$data = $this->modelNilaiKriteria->find($id);

		if (!$data) {

			return $this->response->setJSON([
				'status' => false,
				'message' => 'Data tidak ditemukan.'
			]);

		}

		return $this->response->setJSON([
			'status' => true,
			'data' => $data
		]);
	}

}