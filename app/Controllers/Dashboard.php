<?php

namespace App\Controllers;
use App\Models\WilayahModel;
use App\Models\KeluargaModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $WilayahModel = new WilayahModel();
        $KeluargaModel = new KeluargaModel();
        $jumlahDusun = $WilayahModel->where('jenis', 'dusun')->countAllResults();
        $jumlahRW= $WilayahModel->where('jenis', 'rw')->countAllResults();
        $jumlahRt= $WilayahModel->where('jenis', 'rt')->countAllResults();
         $jumlahKK= $KeluargaModel->countAllResults();

         $data = [
            'jmlDusun' => $jumlahDusun,
            'jmlRW'=> $jumlahRW,
            'jmlRT' => $jumlahRt,
            'jmlKK' => $jumlahKK
        ];
        return view('/dashboard/dashboard_view',$data);
    }
    
     public function dash_kepaladesa()
    {
        $WilayahModel = new WilayahModel();
        $KeluargaModel = new KeluargaModel();
        $jumlahDusun = $WilayahModel->where('jenis', 'dusun')->countAllResults();
        $jumlahRW= $WilayahModel->where('jenis', 'rw')->countAllResults();
        $jumlahRt= $WilayahModel->where('jenis', 'rt')->countAllResults();
         $jumlahKK= $KeluargaModel->countAllResults();

         $data = [
            'jmlDusun' => $jumlahDusun,
            'jmlRW'=> $jumlahRW,
            'jmlRT' => $jumlahRt,
            'jmlKK' => $jumlahKK
        ];
        return view('/dashboard/dashboard_view',$data);
    }
}