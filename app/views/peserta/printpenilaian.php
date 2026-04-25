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
    .table-ttd td {
        border: none;
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

    <h2 class="center">PENILAIAN PESERTA MAGANG DISKOMINFO MEDAN</h2>
    <br>
    <table class="info-table">
        <tr>
            <td>Nama</td>
            <td>: <?= $data['user']['fullname_peserta'] ?></td>
        </tr>
        <tr>
            <td>Instansi</td>
            <td>: <?= $data['user']['instansi'] ?></td>
        </tr>
        <tr>
            <td>Divisi Magang</td>
            <td>: <?= $data['user']['divisi_magang'] ?></td>
        </tr>
        <tr>
            <td>Mentor</td>
            <td>: <?= $data['mentor']['fullname'] ?></td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th scope="col" style="width: 5%; text-align:center; vertical-align:middle">#</th>
                <th scope="col" style="width: 20%; text-align:center; vertical-align:middle">Aspek Penilaian</th>
                <th scope="col" style="width: 30%; text-align:center; vertical-align:middle">Indikator Penilaian</th>
                <th scope="col" style="width: 15%; text-align:center; vertical-align:middle">Penilaian (0-100)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center;">1</td>
                <td rowspan="4" style="text-align: center; vertical-align:middle">Sikap</td>
                <td>Disiplin</td>
                <td style="text-align: center;"><?= empty($data['penilaian']['n_disiplin']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_disiplin'] ?></td>
            </tr>
            <tr>
                <td style="text-align: center;">2</td>
                <td>Kejujuran</td>
                <td style="text-align: center;"><?= empty($data['penilaian']['n_kejujuran']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_kejujuran'] ?></td>
            </tr>
            <tr>
                <td style="text-align: center;">3</td>
                <td>Etika</td>
                <td style="text-align: center;"><?= empty($data['penilaian']['n_etika']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_etika'] ?></td>
            </tr>
            <tr>
                <td style="text-align: center;">4</td>
                <td>Tanggung Jawab</td>
                <td style="text-align: center;"><?= empty($data['penilaian']['n_tanggungjawab']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_tanggungjawab'] ?></td>
            </tr>
            <tr>
                <td style="text-align: center;">5</td>
                <td rowspan="3" style="text-align: center; vertical-align:middle">Komunikasi</td>
                <td>Kerjasama Tim</td>
                <td style="text-align: center;"><?= empty($data['penilaian']['n_kerjatim']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_kerjatim'] ?></td>
            </tr>
            <tr>
                <td style="text-align: center;">6</td>
                <td>Aktif Diskusi</td>
                <td style="text-align: center;"><?= empty($data['penilaian']['n_aktifdiskusi']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_aktifdiskusi'] ?></td>
            </tr>
            <tr>
                <td style="text-align: center;">7</td>
                <td>Komunikatif</td>
                <td style="text-align: center;"><?= empty($data['penilaian']['n_komunikatif']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_komunikatif'] ?></td>
            </tr>
            <tr>
                <td style="text-align: center;">8</td>
                <td rowspan="3" style="text-align: center; vertical-align:middle">Kemampuan Teknis</td>
                <td>Penerapan Ilmu Jurusan</td>
                <td style="text-align: center;"><?= empty($data['penilaian']['n_ilmujurusan']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_ilmujurusan'] ?></td>
            </tr>
            <tr>
                <td style="text-align: center;">9</td>
                <td>Penggunaan Alat Kerja</td>
                <td style="text-align: center;"><?= empty($data['penilaian']['n_penggunaansoftware']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_penggunaansoftware'] ?></td>
            </tr>
            <tr>
                <td style="text-align: center;">10</td>
                <td>Kualitas Hasil Kerja</td>
                <td style="text-align: center;"><?= empty($data['penilaian']['n_hasilkerja']) ? '<i>Belum diisi mentor</i>' : $data['penilaian']['n_hasilkerja'] ?></td>
            </tr>
            <tr class="border-secondary-subtle">
                <td colspan="3" style="text-align: center;" class="fw-bold bg-secondary-subtle border-secondary-subtle">Total Rata-Rata</td>
                <td style="text-align: center;" class="fw-bold bg-secondary-subtle border-secondary-subtle"><?= (empty($data['penilaian'])) ? 0 : (($data['penilaian']['n_disiplin'] + $data['penilaian']['n_kejujuran'] + $data['penilaian']['n_etika'] + $data['penilaian']['n_tanggungjawab'] + $data['penilaian']['n_ilmujurusan'] + $data['penilaian']['n_penggunaansoftware'] + $data['penilaian']['n_hasilkerja'] + $data['penilaian']['n_kerjatim'] + $data['penilaian']['n_komunikatif'] + $data['penilaian']['n_aktifdiskusi']) / 10) ?></td>
            </tr>
        </tbody>
    </table>
    <br><br><br>
    <table class="table-ttd">
        <tr>
            <td style="width:50%;"></td>
            <td style="width:50%; text-align:right">
            Medan, <?= date('d M Y', time()) ?><br>
            Mentor Magang,<br><br><br><br><br>
            <strong><?= $data['mentor']['fullname'] ?></strong>
            </td>
        </tr>
    </table>

</body>
</html>