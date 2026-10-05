<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    public function getData()
    {
        return [
            ['id' => 1, 'nama' => 'Andi', 'nim' => '12345', 'jurusan' => 'Informatika'],
            ['id' => 2, 'nama' => 'Budi', 'nim' => '12346', 'jurusan' => 'Sistem Informasi'],
            ['id' => 3, 'nama' => 'Citra', 'nim' => '12347', 'jurusan' => 'Teknik Komputer'],
        ];
    }
}