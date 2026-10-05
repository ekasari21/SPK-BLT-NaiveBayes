<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>

        table td{
            vertical-align: top;
            padding: 5px;
            font-size: 10px;
        }

        table th{
            text-align: center;
            font-size: 10px;
            background: #e9ecef;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table, th, td{
            border:1px solid #000;
        }
    </style>

</head>

<body>

    <h3>LAPORAN HASIL PERSETUJUAN PENERIMA BANTUAN</h3>

    <p>

        <b>Periode :</b>

        <?php

            if($tglAwal != '' && $tglAkhir != ''){

                echo date('d-m-Y',strtotime($tglAwal));
                echo " s/d ";
                echo date('d-m-Y',strtotime($tglAkhir));

            }else{

                echo "Semua";

            }

        ?>

        <br>

        <b>Status :</b>

        <?= $status == '' ? 'Semua' : $status; ?>

    </p>

    <table>

        <thead>

            <tr>

                <th>No</th>

                <th>No KK</th>

                <th>Kepala Keluarga</th>
                <th>Kriteria</th>

                <th>Status</th>

                <th>Tanggal</th>

                <th>Catatan</th>

            </tr>

        </thead>

        <tbody>

            <?php
                $no = 1;

                foreach ($hasil as $row):

                $kriteria = "
                <b>Kepemilikan Kendaraan</b> : {$row['kepemilikan_kendaraan']}<br>
                <b>Kepemilikan Rumah</b> : {$row['kepemilikan_rumah']}<br>
                <b>Kondisi Rumah</b> : {$row['kondisi_rumah']}<br>
                <b>Kepemilikan Tanah</b> : {$row['kepemilikan_tanah']}<br>
                <b>Penghasilan</b> : {$row['penghasilan']}<br>
                <b>Jumlah Tanggungan</b> : {$row['tanggungan']}<br>
                <b>Usia</b> : {$row['usia']} Tahun<br>
                <b>Pekerjaan</b> : {$row['pekerjaan']}
                ";
            ?>

            <tr>

                <td><?= $no++ ?></td>

                <td><?= $row['no_kk'] ?></td>

                <td><?= $row['kepala_keluarga'] ?></td>

                <td><?= $kriteria ?></td>

                <td><?= $row['hasil_persetujuan'] ?></td>

                <td>
                    <?= !empty($row['tgl_persetujuan'])
                        ? date('d-m-Y', strtotime($row['tgl_persetujuan']))
                        : '-'; ?>
                    </td>

                    <td><?= $row['catatan'] ?: '-' ?></td>

                </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </body>

    </html>