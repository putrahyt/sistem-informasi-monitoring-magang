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

    <h2 class="center">LAPORAN AKTIVITAS PESERTA MAGANG DISKOMINFO MEDAN</h2>
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
            <td>Mentor</td>
            <td>: <?= $data['profilpeserta']['fullname'] ?></td>
        </tr>
        <tr>
            <td>Periode</td>
            <td>: <?= $data['tanggalAwal'] . ' s.d ' . $data['tanggalAkhir']?></td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 20%;">Tanggal</th>
                <th style="width: 30%;">Aktivitas</th>
                <th style="width: 20%;">Catatan Mentor</th>
                <th style="width: 7%;">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1 ?>
            <?php foreach($data['aktivitas'] as $aktivitas) : ?>
            <tr>
                <td><?= $i ?></td>
                <td style="text-align: left;"><?= date('d F Y H:i:s', $aktivitas['tanggal']) ?></td>
                <td style="text-align: left;"><?= $aktivitas['aktivitas'] ?></td>
                <td style="text-align: left;"><?= empty($aktivitas['catatan_mentor']) ? '-' : $aktivitas['catatan_mentor'] ?></td>
                <?php if($aktivitas['status'] == 0) : ?>
                    <td style="text-align: center;" title="Proses">Proses</td>
                <?php elseif($aktivitas['status'] == 1) : ?>
                    <td style="text-align: center;" title="Acc">Acc</td>
                <?php else : ?>
                    <td style="text-align: center;" title="Ditolak">Ditolak</td>
                <?php endif ?>
            </tr>
            <?php $i++ ?>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>