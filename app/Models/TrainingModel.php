<?php

namespace App\Models;
use CodeIgniter\Model;

class TrainingModel extends Model
{
	protected $table            = 'dataset';
	protected $primaryKey       = 'id_dataset';

	protected $returnType       = 'array';
	protected $useSoftDeletes   = false;

	protected $allowedFields = [
		'id_kk',
		'kepemilikan_kendaraan',
		'kepemilikan_rumah',
		'kondisi_rumah',
		'kepemilikan_tanah',
		'penghasilan',
		'tanggungan',
		'usia', 
		'pekerjaan',
		'label_aktual',
		'status'
	]; 

	public function getDataTraining()
	{
		return $this->db->table('dataset d')
		->select("
			d.id_dataset,
			d.id_kk,
			k.no_kk,
			k.jumlah_anggota,
			k.alamat,

			d.kepemilikan_kendaraan,
			d.kepemilikan_rumah,
			d.kondisi_rumah,
			d.kepemilikan_tanah,
			d.penghasilan,
			d.tanggungan,
			d.usia,
			d.pekerjaan,
			d.label_aktual,
			d.label_prediksi,
			da.nama,
			da.hubungan_keluarga
			")
		->join('keluarga k', 'k.id_kk = d.id_kk')
		->join('detail_anggota da', 'da.id_kk = k.id_kk')
		->where('status', 'Training')
		->orderBy('k.no_kk')
		->get()
		->getResultArray();
	}
	public function getDataKlasifikasi()
	{
		return $this->db->table('dataset d')
		->select("
			d.id_dataset,
			d.id_kk,
			k.no_kk,
			k.jumlah_anggota,
			k.alamat,

			d.kepemilikan_kendaraan,
			d.kepemilikan_rumah,
			d.kondisi_rumah,
			d.kepemilikan_tanah,
			d.penghasilan,
			d.tanggungan,
			d.usia,
			d.pekerjaan,
			d.label_aktual,
			d.label_prediksi,
			da.nama,
			da.hubungan_keluarga
			")
		->join('keluarga k', 'k.id_kk = d.id_kk')
		->join('detail_anggota da', 'da.id_kk = k.id_kk')
		->where('status', 'Testing')
		->orderBy('k.no_kk')
		->get()
		->getResultArray();
	}
	public function getDataTrainingSetKriteria()
	{
		return $this->db->table('dataset d')
		->select("
			d.id_dataset,
			d.id_kk,
			k.no_kk,
			k.jumlah_anggota,
			k.alamat,

			d.kepemilikan_kendaraan,
			d.kepemilikan_rumah,
			d.kondisi_rumah,
			d.kepemilikan_tanah,
			d.penghasilan,
			d.tanggungan,
			d.usia,
			d.pekerjaan,
			d.label_aktual,
			d.label_prediksi,
			da.nama,
			da.hubungan_keluarga
			")
		->join('keluarga k', 'k.id_kk = d.id_kk')
		->join('detail_anggota da', 'da.id_kk = k.id_kk')
		->where('da.hubungan_keluarga', 'Kepala Keluarga')
		->where('status', 'Training')
		->where('kepemilikan_kendaraan IS NOT NULL', null, false)
		->where('kepemilikan_kendaraan !=', '')
		->where('kepemilikan_rumah IS NOT NULL', null, false)
		->where('kepemilikan_rumah !=', '')
		->where('kondisi_rumah IS NOT NULL', null, false)
		->where('kondisi_rumah !=', '')
		->where('kepemilikan_tanah IS NOT NULL', null, false)
		->where('kepemilikan_tanah !=', '')
		->where('penghasilan IS NOT NULL', null, false)
		->where('penghasilan !=', '')
		->where('tanggungan IS NOT NULL', null, false)
		->where('tanggungan !=', '')
		->where('usia IS NOT NULL', null, false)
		->where('usia !=', '')
		->where('pekerjaan IS NOT NULL', null, false)
		->where('pekerjaan !=', '')
		->where('label_aktual IS NOT NULL', null, false)
		->where('label_aktual !=', '')
		->orderBy('k.no_kk')
		->get()
		->getResultArray();
	}
	public function jmlTraining(){
		return $jumlahTraining = $this->db->table('dataset')
		->where('status', 'Training')
		->countAllResults();
	}

	public function jmlTesting(){
		return $jumlahTraining = $this->db->table('dataset')
		->where('status', 'Testing')
		->countAllResults();
	}

	public function jmlNotSetTraining(){
		return $jumlahBelumSet = $this->db->table('dataset')
		->where('status', 'Training')
		->groupStart()
		->where('kepemilikan_kendaraan', '')
		->where('kepemilikan_rumah', '')
		->where('kondisi_rumah', '')
		->where('kepemilikan_tanah', '')
		->where('penghasilan', '')
		->where('tanggungan', '')
		->where('usia', '')
		->where('pekerjaan', '')
		->groupEnd()
		->countAllResults();
	}
	public function jmlNotSetTesting(){
		return $jumlahBelumSet = $this->db->table('dataset')
		->where('status', 'Testing')
		->groupStart()
		->where('kepemilikan_kendaraan', '')
		->where('kepemilikan_rumah', '')
		->where('kondisi_rumah', '')
		->where('kepemilikan_tanah', '')
		->where('penghasilan', '')
		->where('tanggungan', '')
		->where('usia', '')
		->where('pekerjaan', '')
		->groupEnd()
		->countAllResults();
	}
	public function jmlSudahSetTraining()
	{
		return $this->db->table('dataset')
		->where('status', 'Training')
		->where('kepemilikan_kendaraan IS NOT NULL', null, false)
		->where('kepemilikan_kendaraan !=', '')
		->where('kepemilikan_rumah IS NOT NULL', null, false)
		->where('kepemilikan_rumah !=', '')
		->where('kondisi_rumah IS NOT NULL', null, false)
		->where('kondisi_rumah !=', '')
		->where('kepemilikan_tanah IS NOT NULL', null, false)
		->where('kepemilikan_tanah !=', '')
		->where('penghasilan IS NOT NULL', null, false)
		->where('penghasilan !=', '')
		->where('tanggungan IS NOT NULL', null, false)
		->where('tanggungan !=', '')
		->where('usia IS NOT NULL', null, false)
		->where('usia !=', '')
		->where('pekerjaan IS NOT NULL', null, false)
		->where('pekerjaan !=', '')
		-> where ('label_aktual IS NOT NULL',null,false)
		-> where('label_aktual !=','')
		->countAllResults();
	}
	public function jmlSudahSetTesting()
	{
		return $this->db->table('dataset')
		->where('status', 'Testing')
		->where('kepemilikan_kendaraan IS NOT NULL', null, false)
		->where('kepemilikan_kendaraan !=', '')
		->where('kepemilikan_rumah IS NOT NULL', null, false)
		->where('kepemilikan_rumah !=', '')
		->where('kondisi_rumah IS NOT NULL', null, false)
		->where('kondisi_rumah !=', '')
		->where('kepemilikan_tanah IS NOT NULL', null, false)
		->where('kepemilikan_tanah !=', '')
		->where('penghasilan IS NOT NULL', null, false)
		->where('penghasilan !=', '')
		->where('tanggungan IS NOT NULL', null, false)
		->where('tanggungan !=', '')
		->where('usia IS NOT NULL', null, false)
		->where('usia !=', '')
		->where('pekerjaan IS NOT NULL', null, false)
		->where('pekerjaan !=', '')
		-> where ('label_aktual IS NOT NULL',null,false)
		-> where('label_aktual !=','')
		->countAllResults();
	}
	

	public function hitungPosteriorTesting()
	{
    // Ambil seluruh data testing
		$dataTesting = $this->where('status', 'Testing')
		->where('id_dataset NOT IN (SELECT id_dataset FROM hasil_prediksi)', null, false)
		->where('kepemilikan_kendaraan IS NOT NULL', null, false)
		->where('kepemilikan_kendaraan !=', '')
		->where('kepemilikan_rumah IS NOT NULL', null, false)
		->where('kepemilikan_rumah !=', '')
		->where('kondisi_rumah IS NOT NULL', null, false)
		->where('kondisi_rumah !=', '')
		->where('kepemilikan_tanah IS NOT NULL', null, false)
		->where('kepemilikan_tanah !=', '')
		->where('penghasilan IS NOT NULL', null, false)
		->where('penghasilan !=', '')
		->where('tanggungan IS NOT NULL', null, false)
		->where('tanggungan !=', '')
		->where('usia IS NOT NULL', null, false)
		->where('usia !=', '')
		->where('pekerjaan IS NOT NULL', null, false)
		->where('pekerjaan !=', '')
		->findAll();

		if (empty($dataTesting)) {
			return [];
		}

    // Prior
		$prior = $this->hitungPrior();

    // Probabilitas Kondisional
		$probabilitas = $this->getProbabilitasKondisional();

		$mapping = [
			'C1' => 'kepemilikan_kendaraan',
			'C2' => 'kepemilikan_rumah',
			'C3' => 'kondisi_rumah',
			'C4' => 'kepemilikan_tanah',
			'C5' => 'penghasilan',
			'C6' => 'tanggungan',
			'C7' => 'usia',
			'C8' => 'pekerjaan'
		];

		$hasil = [];

		foreach ($dataTesting as $testing) {

			$posteriorLayak = $prior['prior_layak'];
			$posteriorTidak = $prior['prior_tidak_layak'];

			$detail = [];

			foreach ($mapping as $kode => $field) {

				$nilaiTesting = $testing[$field];

				foreach ($probabilitas as $p) {

					if (
						$p['kode_kriteria'] == $kode &&
						$p['kategori'] == $nilaiTesting
					) {

						$posteriorLayak *= $p['prob_layak'];
						$posteriorTidak *= $p['prob_tidak'];

						$detail[] = [
							'kode_kriteria' => $kode,
							'kriteria'      => $p['kriteria'],
							'kategori'      => $nilaiTesting,
							'prob_layak'    => $p['prob_layak'],
							'prob_tidak'    => $p['prob_tidak']
						];

						break;
					}
				}
			}

			$labelPrediksi = ($posteriorLayak >= $posteriorTidak)
			? 'Layak'
			: 'Tidak Layak';

			

			$hasil[] = [

				'id_dataset' => $testing['id_dataset'],
				'id_kk' => $testing['id_kk'],

				'posterior_layak' => $posteriorLayak,

				'posterior_tidak_layak' => $posteriorTidak,

				'hasil' => $labelPrediksi,

				'detail' => $detail

			];

		}
		return $hasil;

	}
	public function cekValueKriteriaByDataset($id_kk)
	{
		return $this->db->table('dataset')
		->select("
			kepemilikan_kendaraan,
			kepemilikan_rumah,
			kondisi_rumah,
			kepemilikan_tanah,
			penghasilan,
			tanggungan,
			usia,
			pekerjaan,
			label_aktual
			")
		->where('id_kk', $id_kk)
		->get()
		->getRowArray();
	}
	public function hitungPrior()
	{
		$builder = $this->db->table('dataset');

    // Hanya data training yang lengkap
		$builder->where('status', 'Training')
		->where('kepemilikan_kendaraan IS NOT NULL', null, false)
		->where('kepemilikan_kendaraan !=', '')
		->where('kepemilikan_rumah IS NOT NULL', null, false)
		->where('kepemilikan_rumah !=', '')
		->where('kondisi_rumah IS NOT NULL', null, false)
		->where('kondisi_rumah !=', '')
		->where('kepemilikan_tanah IS NOT NULL', null, false)
		->where('kepemilikan_tanah !=', '')
		->where('penghasilan IS NOT NULL', null, false)
		->where('penghasilan !=', '')
		->where('tanggungan IS NOT NULL', null, false)
		->where('tanggungan !=', '')
		->where('usia IS NOT NULL', null, false)
		->where('usia !=', '')
		->where('pekerjaan IS NOT NULL', null, false)
		->where('pekerjaan !=', '')
		->where('label_aktual IS NOT NULL', null, false)
		->where('label_aktual !=', '');

		$data = $builder->get()->getResultArray();

		$total = count($data);

		$jumlahLayak = 0;
		$jumlahTidakLayak = 0;

		foreach ($data as $row) {

			if ($row['label_aktual'] == 'Layak') {
				$jumlahLayak++;
			} elseif ($row['label_aktual'] == 'Tidak Layak') {
				$jumlahTidakLayak++;
			}
		}

		return [
			'total_training'      => $total,
			'jumlah_layak'        => $jumlahLayak,
			'jumlah_tidak_layak'  => $jumlahTidakLayak,
			'prior_layak'         => $total > 0 ? $jumlahLayak / $total : 0,
			'prior_tidak_layak'   => $total > 0 ? $jumlahTidakLayak / $total : 0,
		];
	}

	public function getProbabilitasKondisional()
	{
		$mapping = [
			1 => 'kepemilikan_kendaraan',
			2 => 'kepemilikan_rumah',
			3 => 'kondisi_rumah',
			4 => 'kepemilikan_tanah',
			5 => 'penghasilan',
			6 => 'tanggungan',
			7 => 'usia',
			8 => 'pekerjaan'
		];

		$hasil = [];

    // jumlah masing-masing kelas
		$jumlahLayak = $this->where('status','Training')
		->where('label_aktual','Layak')
		->countAllResults();

		$jumlahTidakLayak = $this->where('status','Training')
		->where('label_aktual','Tidak Layak')
		->countAllResults();

		$builder = $this->db->table('nilai_kriteria nk');
		$builder->select('nk.*,k.nama_kriteria, k.kode_kriteria');
		$builder->join('kriteria k','k.id_kriteria=nk.id_kriteria');
		$builder->orderBy('nk.id_kriteria');
		$nilai = $builder->get()->getResultArray();

		foreach($nilai as $n){

			$field = $mapping[$n['id_kriteria']];

        // jumlah kategori pada kriteria tsb
			$jumlahKategori = $this->db
			->table('nilai_kriteria')
			->where('id_kriteria',$n['id_kriteria'])
			->countAllResults();

			$layak = $this->where('status','Training')
			->where('label_aktual','Layak')
			->where($field,$n['kategori'])
			->countAllResults();

			$tidak = $this->where('status','Training')
			->where('label_aktual','Tidak Layak')
			->where($field,$n['kategori'])
			->countAllResults();

        // Laplace Smoothing
			$probLayak = ($layak+1)/($jumlahLayak+$jumlahKategori);
			$probTidak = ($tidak+1)/($jumlahTidakLayak+$jumlahKategori);

			$hasil[]=[
				'kriteria'=>$n['nama_kriteria'],
				'kode_kriteria'=>$n['kode_kriteria'],
				'kategori'=>$n['kategori'],
				'jumlah_layak'=>$layak,
				'jumlah_tidak'=>$tidak,
				'prob_layak'=>$probLayak,
				'prob_tidak'=>$probTidak
			];
		}

		return $hasil;
	}


}


