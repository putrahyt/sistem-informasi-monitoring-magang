<?php
date_default_timezone_set('Asia/Jakarta');

class Tamu extends Controller {
    public function __construct()
    {
        Helper::is_logged_in();
    }

    public function index()
    {
        header("Location: " . BASEURL . '/tamu/search');
        exit;
    }

    // public function peserta($id = 1) {
    //     $dataperhal = 30;
    //     $data['jmlPeserta'] = count($this->model('Admin_model')->getAllPeserta());
    //     $data['jmlHalaman'] = ceil($data['jmlPeserta'] / $dataperhal);
    //     $data['hlmAktif'] = $id;
    //     $data['awalData'] = ($dataperhal * $data['hlmAktif']) - $dataperhal;
    //     $arr = [$data['awalData'], $dataperhal];

    //     if(!empty($_POST['keyword'])) {
    //         $data["peserta"] = $this->model('Admin_model')->cariPeserta($_POST, [0, 60]);
    //     } else {
    //         $data["peserta"] = $this->model('Admin_model')->paginationPeserta($arr);
    //     }

    //     $data["judul"] = "Tamu - Peserta Magang";
    //     $this->view('templates/header', $data);
    //     $this->view('tamu/index', $data);
    //     $this->view('templates/footer');
    // }

    // public function detailpeserta($id = null) {
    //     $data["peserta"] = $this->model('Admin_model')->getPesertaById($id);
        
    //     if(empty($data['peserta'])) {
    //         header("Location: " . BASEURL . "/tamu");
    //         exit;
    //     }
        
    //     $data["mentormagang"] = $this->model('Admin_model')->getUsernameMentor($data["peserta"]["mentor_magang"]);
    //     $data["judul"] = "Tamu - Detail Peserta Magang";
    //     $this->view('templates/header', $data);
    //     $this->view('tamu/detailpeserta', $data);
    //     $this->view('templates/footer');
    // }

    public function search() {
        // Tombol laporan
        if(isset($_POST['tombollaporan'])) {
            $data['profilpeserta'] = $this->model('Peserta_model')->getUsernamePesertadanMentor($_POST['namapeserta']);
            $data['periode'] = $_POST['periode'];
            $tanggal = explode(' - ', $data['periode']);
            $data['tanggalAwal'] = date('d-m-Y', strtotime(str_replace('/', '-', $tanggal[0])));
            $data['tanggalAkhir'] = date('d-m-Y', strtotime(str_replace('/', '-', $tanggal[1])));

            if($_POST['tipepencarian'] == 'absensi') {
                $data['laporan'] = 'Absensi';
                $data['absensi'] = $this->model('Admin_model')->laporanabsensipeserta($_POST['namapeserta'], $_POST['periode']);
            }

            if($_POST['tipepencarian'] == 'aktivitas') {
                $data['laporan'] = 'Aktivitas';
                $data['aktivitas'] = $this->model('Admin_model')->laporanaktivitaspeserta($_POST['namapeserta'], $_POST['periode']);
            }

        }

        $data['peserta'] = $this->model('Admin_model')->getAllPeserta();
        $data["judul"] = "Admin - Laporan";
        $this->view('templates/header', $data);
        $this->view('tamu/search', $data);
        $this->view('templates/footer');
    }
}