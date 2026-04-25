<?php
date_default_timezone_set('Asia/Jakarta');

class Admin extends Controller {
    public function __construct()
    {
        Helper::is_logged_in();
    }

    public function index() {
        $data['totalpeserta'] = count($this->model('Admin_model')->getAllPeserta());
        $data['totalmentor'] = count($this->model('Admin_model')->getAllMentor());
        $data['aktivitas'] = $this->model('Admin_model')->getAktivitasHariIni();
        $data['absensipeserta'] = $this->model('Admin_model')->getAbsensiHariIni();
        $data["judul"] = "Halaman Admin";
        $this->view('templates/header', $data);
        $this->view('admin/index', $data);
        $this->view('templates/footer');
    }

    public function datamentor($id=1) {
        $dataperhal = 30;
        $data['jmlMentor'] = count($this->model('Admin_model')->getAllMentor());
        $data['jmlHalaman'] = ceil($data['jmlMentor'] / $dataperhal);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($dataperhal * $data['hlmAktif']) - $dataperhal;
        $arr = [$data['awalData'], $dataperhal];

        if(!empty($_POST['keyword'])) {
            $data["mentor"] = $this->model('Admin_model')->cariMentor($_POST, [0, 60]);
        } else {
            $data["mentor"] = $this->model('Admin_model')->paginationMentor($arr);
        }

        $data["judul"] = "Admin - Data Mentor";
        $this->view('templates/header', $data);
        $this->view('admin/datamentor', $data);
        $this->view('templates/footer');
    }

    public function addnewmentor() {
        if(isset($_POST['tambahmentor'])) {

            // Validasi Mentor
            $checkUsername = $this->model('Admin_model')->getUsernameMentor($_POST['username']);
            if($checkUsername) {
                Flasher::setFlash("Username tersebut sudah digunakan", "error");
                header("Location: " . BASEURL . "/admin/addnewmentor");
                exit;
            } else if(strlen($_POST['password']) < 5){
                Flasher::setFlash("Password setidaknya minimal 5 karakter", "error");
                header("Location: " . BASEURL . "/admin/addnewmentor");
                exit;
            }
            
            // Tambah Mentor
            if($this->model('Admin_model')->addMentor($_POST) > 0) {
                Flasher::setFlash("Berhasil tambah akun mentor", "success");
                header("Location: " . BASEURL . "/admin/addnewmentor");
                exit;
            } else {
                Flasher::setFlash("Gagal tambah akun", "error");
                header("Location: " . BASEURL . "/admin/addnewmentor");
                exit;
            }
        } 

        $data["judul"] = "Admin - Tambah Mentor";
        $this->view('templates/header', $data);
        $this->view('admin/addnewmentor');
        $this->view('templates/footer');
    }

    public function deletementor($id) {
        $mentor = $this->model('Admin_model')->getMentorById($id);

        if(empty($mentor)) {
            header("Location: " . BASEURL . "/admin/datamentor");
            exit;
        }

        if($this->model('Admin_model')->deleteMentor($id) > 0) {
            Flasher::setFlash("Data mentor berhasil dihapus", "success");
            header("Location: " . BASEURL . "/admin/datamentor");
            exit;
        } else {
            Flasher::setFlash("Gagal hapus data", "error");
            header("Location: " . BASEURL . "/admin/datamentor");
            exit;
        }
    }

    public function editmentor($id = null) {
        $data["mentor"] = $this->model('Admin_model')->getMentorById($id);
        
        if(empty($data['mentor'])) {
            header("Location: " . BASEURL . "/admin/datamentor");
            exit;
        }

        // Ubah Password
        if(isset($_POST['ubahpasswordmentor'])) {
            //Validasi Password
            if(strlen($_POST['password1']) < 5) {
                Flasher::setFlash("Password setidaknya minimal 5 karakter", "error");
                header("Location: " . BASEURL . "/admin/editmentor/" . $id);
                exit;
            } else if($_POST['password1'] !== $_POST['password2']) {
                Flasher::setFlash("Password tidak sama!", "error");
                header("Location: " . BASEURL . "/admin/editmentor/" . $id);
                exit;
            }

            // Ubah
            if($this->model('Admin_model')->ubahPasswordMentor($_POST) > 0) {
                Flasher::setFlash("Password berhasil diubah", "success");
                header("Location: " . BASEURL . "/admin/datamentor");
                exit;
            } else {
                Flasher::setFlash("Password gagal diubah", "error");
                header("Location: " . BASEURL . "/admin/datamentor");
                exit;
            }
        }

        // Edit mentor
        if(isset($_POST['editmentor'])) {

            // validasi username
            $checkUsername = $this->model('Admin_model')->getUsernameMentor($_POST['username']);
            if($checkUsername && ($checkUsername["username"] !== $data["mentor"]["username"])) {
                Flasher::setFlash("Username tersebut sudah digunakan", "error");
                header("Location: " . BASEURL . "/admin/editmentor/" . $id);
                exit;
            }

            // Ubah mentor
            if($this->model('Admin_model')->ubahMentor($_POST, $data["mentor"]["username"]) > 0) {
                Flasher::setFlash("Data mentor berhasil diubah", "success");
                header("Location: " . BASEURL . "/admin/datamentor/");
                exit;
            } else {
                header("Location: " . BASEURL . "/admin/datamentor/");
                exit;
            }
        }



        $data["judul"] = "Admin - Edit Mentor";
        $this->view('templates/header', $data);
        $this->view('admin/editmentor', $data);
        $this->view('templates/footer');
    }

    public function detailmentor($id = null, $idPage = 1) {
        $data["mentor"] = $this->model('Admin_model')->getMentorById($id);
        
        if(empty($data['mentor'])) {
            header("Location: " . BASEURL . "/admin/datamentor");
            exit;
        }

        $dataperhal = 15;
        $data['jmlPeserta'] = count($this->model('Admin_model')->getAllPesertaByMentor($data["mentor"]["username"]));
        $data['jmlHalaman'] = ceil($data['jmlPeserta'] / $dataperhal);
        $data['hlmAktif'] = $idPage;
        $data['awalData'] = ($dataperhal * $data['hlmAktif']) - $dataperhal;
        $arr = [$data['awalData'], $dataperhal];

        if(!empty($_POST['keyword'])) {
            $data["peserta"] = $this->model('Admin_model')->cariPesertaatMentor($_POST, [0, 30], $data["mentor"]["username"]);
        } else {
            $data["peserta"] = $this->model('Admin_model')->paginationPesertaatMentor($arr, $data["mentor"]["username"]);
        }
        
        $data["totalpeserta"] = $this->model('Mentor_model')->getTotalPesertaByMentor($data["mentor"]["username"]);
        $data["id"] = $id;
        $data["judul"] = "Admin - Detail Mentor";
        $this->view('templates/header', $data);
        $this->view('admin/detailmentor', $data);
        $this->view('templates/footer');
    }

    public function datapeserta($id = 1) {
        $dataperhal = 30;
        $data['jmlPeserta'] = count($this->model('Admin_model')->getAllPeserta());
        $data['jmlHalaman'] = ceil($data['jmlPeserta'] / $dataperhal);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($dataperhal * $data['hlmAktif']) - $dataperhal;
        $arr = [$data['awalData'], $dataperhal];

        if(!empty($_POST['keyword'])) {
            $data["peserta"] = $this->model('Admin_model')->cariPeserta($_POST, [0, 60]);
        } else {
            $data["peserta"] = $this->model('Admin_model')->paginationPeserta($arr);
        }

        $data["judul"] = "Admin - Data Peserta";
        $this->view('templates/header', $data);
        $this->view('admin/datapeserta', $data);
        $this->view('templates/footer');
    }

    public function detailpeserta($id = null) {
        $data["peserta"] = $this->model('Admin_model')->getPesertaById($id);
        
        if(empty($data['peserta'])) {
            header("Location: " . BASEURL . "/admin/datapeserta");
            exit;
        }
        
        $data["mentormagang"] = $this->model('Admin_model')->getUsernameMentor($data["peserta"]["mentor_magang"]);
        $data["judul"] = "Admin - Detail Peserta";
        $this->view('templates/header', $data);
        $this->view('admin/detailpeserta', $data);
        $this->view('templates/footer');
    }

    public function deletepeserta($id) {
        $peserta = $this->model('Admin_model')->getPesertaById($id);

        if(empty($peserta)) {
            header("Location: " . BASEURL . "/admin/datapeserta");
            exit;
        }

        $datadiripeserta = $this->model('Peserta_model')->getProfilPeserta($peserta['username']);
        $absensi = $this->model('Peserta_model')->getAbsensi($peserta['username']);
        $aktivitas = $this->model('Peserta_model')->getAktivitasPeserta($peserta['username']);
        $bimbingan = $this->model('Peserta_model')->getPesan($peserta['username']);
        $penilaian = $this->model('Peserta_model')->getPenilaianPesertaByUsn($peserta['username']);
        if($this->model('Admin_model')->deletePeserta($peserta, $datadiripeserta, $absensi, $aktivitas, $bimbingan, $penilaian) > 0) {
            Flasher::setFlash("Data peserta berhasil dihapus", "success");
            header("Location: " . BASEURL . "/admin/datapeserta");
            exit;
        } else {
            Flasher::setFlash("Gagal hapus data", "error");
            header("Location: " . BASEURL . "/admin/datapeserta");
            exit;
        }
    }

    public function pengaturan() {
        $data["user"] = $this->model('Admin_model')->getUsernameAdmin($_SESSION['session']['username']);
        $data['koordinat'] = $this->model('Admin_model')->getKoordinat();

        // Ubah Email atau Username
        if(isset($_POST['editadmin'])) {
            
            // validasi email
            if(!filter_var(trim($_POST['email']),FILTER_VALIDATE_EMAIL)) {
                Flasher::setFlash('Invalid email format', 'error');
                header("Location: " . BASEURL . '/admin/pengaturan');
                exit;
            }

            if($this->model('Admin_model')->ubahEmailorUsername($_POST) > 0) {
                $_SESSION['session']['username'] = strtolower(stripslashes(htmlspecialchars($_POST['username'])));
                Flasher::setFlash('Email / username berhasil diubah', 'success');
                header("Location: " . BASEURL . '/admin/pengaturan');
                exit;
            }
            
        }
        
        // Ubah password
        if(isset($_POST['ubahpasswordadmin'])) {
            if(password_verify($_POST['currentpassword'], $data['user']['password'])) {
                
                if(strlen($_POST['password1']) < 5) {
                    Flasher::setFlash('Password setidaknya minimal 5 karakter', 'error');
                    header("Location: " . BASEURL . '/admin/pengaturan');
                    exit;
                } else if($_POST['password1'] !== $_POST['password2']) {
                    Flasher::setFlash('Password tidak sama', 'error');
                    header("Location: " . BASEURL . '/admin/pengaturan');
                    exit;
                }

                // Ubah password
                if($this->model('Admin_model')->ubahPassword($_POST)> 0) {
                    Flasher::setFlash('Password berhasil diubah', 'success');
                    header("Location: " . BASEURL . '/admin/pengaturan');
                    exit;
                } else {
                    Flasher::setFlash('Password gagal diubah', 'error');
                    header("Location: " . BASEURL . '/admin/pengaturan');
                    exit;
                }

            } else {
                Flasher::setFlash('Password lama anda salah', 'error');
                header("Location: " . BASEURL . '/admin/pengaturan');
                exit;
            }
        }

        // Ubah koordinat
        if(isset($_POST['ubahkoordinat'])) {
            if(!is_numeric($_POST['latitude']) || !is_numeric($_POST['longitude']) || !is_numeric($_POST['jarak'])) {
                Flasher::setFlash('Input harus berupa angka', 'error');
                header("Location: " . BASEURL . '/admin/pengaturan');
                exit;
            }

            if($this->model('Admin_model')->ubahKoordinat($_POST, $data['koordinat']['id_pengaturan'])> 0) {
                Flasher::setFlash('Koordinat berhasil diubah', 'success');
                header("Location: " . BASEURL . '/admin/pengaturan');
                exit;
            } 
        }

        $data["judul"] = "Admin - Ubah Password";
        $this->view('templates/header', $data);
        $this->view('admin/pengaturan', $data);
        $this->view('templates/footer');
    }

    public function laporan() {
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
        $this->view('admin/laporan', $data);
        $this->view('templates/footer');
    }

    public function printabsensi() {
        if(empty($_POST['peserta']) && empty($_POST['periode'])) {
            header("Location: " . BASEURL . '/admin/laporan');
            exit;
        }
        $tanggal = explode(' - ', $_POST['periode']);
        $data['tanggalAwal'] = date('d-m-Y', strtotime(str_replace('/', '-', $tanggal[0])));
        $data['tanggalAkhir'] = date('d-m-Y', strtotime(str_replace('/', '-', $tanggal[1])));

        $data['profilpeserta'] = $this->model('Peserta_model')->getUsernamePesertadanMentor($_POST['peserta']);
        $data['absensi'] = $this->model('Admin_model')->laporanabsensipeserta($_POST['peserta'], $_POST['periode']);
        
        $data["judul"] = "Print Absensi";
        $this->view('admin/printabsensi', $data);
    }

    public function printaktivitas() {
        if(empty($_POST['peserta']) && empty($_POST['periode'])) {
            header("Location: " . BASEURL . '/admin/laporan');
            exit;
        }

        $tanggal = explode(' - ', $_POST['periode']);
        $data['tanggalAwal'] = date('d-m-Y', strtotime(str_replace('/', '-', $tanggal[0])));
        $data['tanggalAkhir'] = date('d-m-Y', strtotime(str_replace('/', '-', $tanggal[1])));

        $data['profilpeserta'] = $this->model('Peserta_model')->getUsernamePesertadanMentor($_POST['peserta']);
        $data['aktivitas'] = $this->model('Admin_model')->laporanaktivitaspeserta($_POST['peserta'], $_POST['periode']);
        
        $data["judul"] = "Print Aktivitas";
        $this->view('admin/printaktivitas', $data);
    }
}