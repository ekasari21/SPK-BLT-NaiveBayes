<?php

namespace App\Controllers;


class Klasifikasi extends BaseController
{
	public function index()
	{
		return view('dataset/hasil_klasifikasi');
	}
}