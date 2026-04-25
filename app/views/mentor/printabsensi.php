<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul'] ?></title>
    <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 14px;
    }
    .center {
      text-align: center;
      font-weight: bold;
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    td, th {
      border: 1px solid #000;
      padding: 6px;
      text-align: center;
    }
    .info-table {
      width: 60%;
      margin-bottom: 20px;
    }
    .info-table td {
      border: none;
      text-align: left;
      padding: 4px 0;
    }

    @media print {
      @page {
        margin: 2cm;
      }

      body {
        margin: 0;
      }

      .kop-surat {
        text-align: center;
        border-bottom: 3px solid black;
        margin-bottom: 20px;
        padding-bottom: 10px;
      }

      .kop-surat h2, .kop-surat h3, .kop-surat p {
        margin: 2px;
        line-height: 1.4;
      }

      .kop-surat img {
        position: absolute;
        left: 20px;
        top: 10px;
        width: 70px;
        height: auto;
      }

      .info-table {
        margin-top: 0;
      }
      
    }
    </style>
</head>
<body onload="window.print()">
    <div class="kop-surat">
      <img src="<?= BASEURL ?>/asset/img/logo kota medan.png" width="50px" alt="Logo">
      <h2>DINAS KOMUNIKASI DAN INFORMATIKA</h2>
      <h2>KOTA MEDAN</h2>
      <p>Jl. Sidorukun No.35, Pulo Brayan Darat II, Kec. Medan Tim.,</p>
      <p>Kota Medan, Sumatera Utara 20239</p>
    </div>    

    <h2 class="center">LAPORAN ABSENSI PESERTA MAGANG DISKOMINFO MEDAN</h2>
    <br>
    <table class="info-table">
        <tr>
            <td>Nama</td>
            <td>: <?= $data['profilpeserta']['fullname_peserta'] ?></td>
        </tr>
        <tr>
            <td>Instansi</td>
            <td>: <?= $data['profilpeserta']['instansi'] ?></td>
        </tr>
        <tr>
            <td>Divisi Magang</td>
            <td>: <?= $data['profilpeserta']['divisi_magang'] ?></td>
        </tr>
        <tr>
            <td>Periode</td>
            <td>: <?= $data['tanggalAwal'] . ' s.d ' . $data['tanggalAkhir']?></td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Hari/Tanggal</th>
                <th>Absensi Masuk</th>
                <th>Jam Masuk</th>
                <th>Absensi Pulang</th>
                <th>Jam Pulang</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1 ?>
            <?php foreach($data['absensi'] as $absensi) : ?>
            <tr>
                <td><?= $i ?></td>
                <td>
                    <?php 
                    $hari = ['Sunday' => 'Minggu','Monday' => 'Senin','Tuesday' => 'Selasa','Wednesday' => 'Rabu','Thursday' => 'Kamis','Friday' => 'Jumat','Saturday' => 'Sabtu'];
                    $bulan = ['01' => 'Januari','02' => 'Februari','03' => 'Maret','04' => 'April','05' => 'Mei','06' => 'Juni','07' => 'Juli','08' => 'Agustus','09' => 'September','10' => 'Oktober','11' => 'November','12' => 'Desember'];
                    $date = new DateTime($absensi['tanggal']); $namaHari = $hari[$date->format('l')]; $tgl = $date->format('d'); $namaBulan = $bulan[$date->format('m')]; $tahun = $date->format('Y'); $hasil = "$namaHari, $tgl $namaBulan $tahun";
                    ?>
                    <?= $hasil ?>
                </td>
                <td style="text-align: center;"><?= ($absensi['absen_masuk'] == 'true') ? '✓' : 'x' ?></td>
                <td style="text-align: center;"><?= (!empty($absensi['jam_masuk']) && $absensi['jam_masuk'] !== 0) ? date('H:i:s', $absensi['jam_masuk']) . ' WIB' : '-' ?></td>
                <td style="text-align: center;">
                    <?php if($absensi['absen_pulang'] == 'true') : ?>
                    ✓
                    <?php elseif($absensi['absen_pulang'] == 'false') : ?>
                    x
                    <?php endif ?>
                </td>
                <td style="text-align: center;">
                    <?php if(!empty($absensi['jam_pulang'])) : ?>
                    <?= date('H:i:s', $absensi['jam_pulang']) . ' WIB' ?>
                    <?php elseif($absensi['jam_pulang'] === 0) : ?>
                    -                                    
                    <?php endif ?>
                </td>
            </tr>
            <?php $i++ ?>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>