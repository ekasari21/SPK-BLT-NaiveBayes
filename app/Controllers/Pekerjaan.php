<?php

namespace App\Controllers;

use App\Models\PekerjaanModel;


class Pekerjaan extends BaseController
{
	protected $model;

    // controller utama
	public function __construct()
	{
		$this->model = new PekerjaanModel();
	}

}
?>