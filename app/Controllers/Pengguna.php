<?php

namespace App\Controllers;

use App\Models\UserModel;


class Pengguna extends BaseController
{
	protected $PenggunaModel;
	public function __construct()
	{
		$this->PenggunaModel = new UserModel();
	}
	public function index()
	{
		return view('pengguna/pengguna_view');
	}
	public function simpanPengguna()
	{
		$username = trim($this->request->getPost('username'));
		$password = $this->request->getPost('password');
		$role     = $this->request->getPost('role');

		if ($username == "" || $password == "" || $role == "") {

			return $this->response->setJSON([
				'status' => false,
				'message' => 'Semua field wajib diisi.'
			]);

		}

		$cek = $this->PenggunaModel
		->where('username', $username)
		->first();

		if ($cek) {

			return $this->response->setJSON([
				'status' => false,
				'message' => 'Username sudah digunakan.'
			]);

		}

		$this->PenggunaModel->insert([

			'username' => $username,

			'password' => password_hash($password, PASSWORD_DEFAULT),

			'role' => $role

		]);

		return $this->response->setJSON([

			'status' => true,

			'message' => 'Pengguna berhasil ditambahkan.'

		]);
	}
	public function getDataUser()
	{
		$data = $this->PenggunaModel->findAll();

		return $this->response->setJSON([
			'data' => $data
		]);
	}
	public function getUser($id)
	{
		$data = $this->PenggunaModel
		->find($id);

		return $this->response->setJSON($data);
	}
	public function update()
	{
		$id = $this->request->getPost('id_user');

		$data = [
			'username' => $this->request->getPost('username'),
			'role'     => $this->request->getPost('role')
		];

		if ($this->request->getPost('password') != "") {
			$data['password'] = password_hash(
				$this->request->getPost('password'),
				PASSWORD_DEFAULT
			);
		}

		$this->PenggunaModel->update($id, $data);

		return $this->response->setJSON([
			'status' => true,
			'message' => 'Data berhasil diubah.'
		]);
	}
	public function hapus()
	{
		if ($this->request->isAJAX()) {

			$id = $this->request->getPost('id_user');


			$cek = $this->PenggunaModel->find($id);

			if (!$cek) {

				return $this->response->setJSON([
					'status'  => false,
					'message' => 'Data tidak ditemukan.'
				]);

			}

			$this->PenggunaModel->delete($id);

			return $this->response->setJSON([
				'status'  => true,
				'message' => 'Data berhasil dihapus.'
			]);

		}
	}
}