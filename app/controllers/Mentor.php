<?php
date_default_timezone_set('Asia/Jakarta');

class Mentor extends Controller {
    public function __construct()
    {
        Helper::is_logged_in();
    }

    public function index() {
        // Notif
        $data["notifbimbingan"] = count($this->model('Mentor_model')->getNotifBimbingan($_SESSION['session']['username']));
        $data['notifaktivitas'] = count($this->model('Mentor_model')->getNotifAktivitas($_SESSION['session']['username']));

        $data['totalpeserta'] = count($this->model('Admin_model')->getAllPesertaByMentor($_SESSION['session']['username']));
        $data['totalaktivitas'] = count($this->model('Mentor_model')->getAktivitasPeserta($_SESSION['session']['username']));
        $data['aktivitas'] = $this->model('Mentor_model')->getAktivitasHariIni($_SESSION['session']['username']);
        $data['absensipeserta'] = $this->model('Mentor_model')->getAbsensiHariIni($_SESSION['session']['username']);
        $data["judul"] = "Halaman Mentor";
        $this->view('templates/header', $data);
        $this->view('mentor/index', $data);
        $this->view('templates/footer');
    }

    public function profil() {
        // Notif
        $data["notifbimbingan"] = count($this->model('Mentor_model')->getNotifBimbingan($_SESSION['session']['username']));
        $data['notifaktivitas'] = count($this->model('Mentor_model')->getNotifAktivitas($_SESSION['session']['username']));
        
        $data["user"] = $this->model('Login_model')->getUsernameMentor($_SESSION['session']['username']);

        // Tombol ubah profil
        if(isset($_POST['ubahdatadiri'])) {
            // validasi
            $checkEmail = $this->model('Login_model')->getEmailMentor(trim($_POST['email']));
            if($checkEmail && ($checkEmail['email'] !== $data['user']['email'])) {
                Flasher::setFlash("Email tersebut sudah digunakan", "error");
                header("Location: " . BASEURL . "/mentor/profil");
                exit;
            } else if(!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
                Flasher::setFlash("Invalid email format", "error");
                header("Location: " . BASEURL . "/mentor/profil");
                exit;
            }

            // validasi image
            $checkImage = $_FILES["gambar"]["error"];
            if($checkImage === 4) {
                $image = $data["user"]["image"];
            } else {
                // cek size
                if($_FILES["gambar"]["size"] > 1200000) {
                    Flasher::setFlash("Maksimal size gambar 1 Mb", "error");
                    header("Location: " . BASEURL . "/mentor/profil");
                    exit;
                }

                // cek ekstensi
                $ekstensiValid = ["jpg","jpeg","png"];
                $explode = explode('.', $_FILES['gambar']['name']);
                $ekstensi = strtolower(end($explode));
                if( !in_array($ekstensi, $ekstensiValid) ) {
                    Flasher::setFlash('Masukkan file dengan ekstensi JPG, JPEG atau PNG', 'error');
                    header("Location: " . BASEURL . '/mentor/profil');
                    exit;
                }

                $image = uniqid() . '.' . $ekstensi;
                move_uploaded_file($_FILES["gambar"]["tmp_name"], 'asset/img/profil/' . $image);
                if($data['user']['image'] !== 'profile.jpg') {
                    unlink('asset/img/profil/' . $data['user']['image']);
                }
            }

            // Ubah profil
            if($this->model('Mentor_model')->ubahProfilMentor($_POST, $image) > 0) {
                Flasher::setFlash('Data diri berhasil diubah', 'success');
                header("Location: " . BASEURL . '/mentor/profil');
                exit;
            }
            
        }

        // Tombol ubah password
        if(isset($_POST['changePassword'])) {
            if(password_verify($_POST['currentpassword'], $data['user']['password'])) {
                
                if(strlen($_POST['newpassword']) < 5) {
                    Flasher::setFlash('Password setidaknya minimal 5 karakter', 'error');
                    header("Location: " . BASEURL . '/mentor/profil');
                    exit;
                } else if($_POST['newpassword'] !== $_POST['renewpassword']) {
                    Flasher::setFlash('Password tidak sama', 'error');
                    header("Location: " . BASEURL . '/mentor/profil');
                    exit;
                }

                // Ubah password
                if($this->model('Mentor_model')->ubahPassword($_POST)> 0) {
                    Flasher::setFlash('Password berhasil diubah', 'success');
                    header("Location: " . BASEURL . '/mentor/profil');
                    exit;
                } else {
                    Flasher::setFlash('Password gagal diubah', 'error');
                    header("Location: " . BASEURL . '/mentor/profil');
                    exit;
                }

            } else {
                Flasher::setFlash('Password lama anda salah', 'error');
                header("Location: " . BASEURL . '/mentor/profil');
                exit;
            }
        }

        $data["totalpeserta"] = $this->model('Mentor_model')->getTotalPesertaByMentor($_SESSION['session']['username']);
        $data["judul"] = "Mentor - Halaman Profil";
        $this->view('templates/header', $data);
        $this->view('mentor/profil', $data);
        $this->view('templates/footer');
    }

    public function bimbingan($id = 1) {
    // Delete Notif bimbingan
    $this->model('Mentor_model')->delNotifBimbingan($_SESSION['session']['username']);

    // Notif Aktivitas
    $data['notifaktivitas'] = count($this->model('Mentor_model')->getNotifAktivitas($_SESSION['session']['username']));

    $data["user"] = $this->model('Login_model')->getUsernameMentor($_SESSION['session']['username']);
    $data["peserta"] = $this->model('Admin_model')->getAllPesertaByMentor($_SESSION['session']['username']);

    // Pagination
    $dataperhal = 20;
    $data['jmlPesan'] = count($this->model('Mentor_model')->getPesan($data['user']['username']));
    $data['jmlHalaman'] = ceil($data['jmlPesan'] / $dataperhal);
    $data['hlmAktif'] = $id;
    $data['awalData'] = ($dataperhal * $data['hlmAktif']) - $dataperhal;
    $arr = [$data['awalData'], $dataperhal];

    $data["bimbingan"] = $this->model('Mentor_model')->getPesanWithPagination($arr, $data['user']['username']);
    
    // Tombol Tanggapan
    if(isset($_POST['tanggapan'])) {
        if($this->model('Mentor_model')->addTanggapan($_POST) > 0) {
            Flasher::setFlash('Berhasil mengirim tanggapan', 'success');
            header("Location: " . BASEURL . '/mentor/bimbingan');
            exit;
        } else {    
            Flasher::setFlash('Gagal mengirim tanggapan', 'error');
            header("Location: " . BASEURL . '/mentor/bimbingan');
            exit;
        }
    }

    // Tombol Pesan
    if(isset($_POST['pesan'])) {
        if($this->model('Mentor_model')->addPesan($_POST, $data['user']['username']) > 0) {
            Flasher::setFlash('Berhasil mengirim pesan', 'success');
            header("Location: " . BASEURL . '/mentor/bimbingan');
            exit;
        } else {    
            Flasher::setFlash('Gagal mengirim pesan', 'error');
            header("Location: " . BASEURL . '/mentor/bimbingan');
            exit;
        }
    }

    $data["judul"] = "Mentor - Halaman Bimbingan";
    $this->view('templates/header', $data);
    $this->view('mentor/bimbingan', $data);
    $this->view('templates/footer');
    }

    public function datapeserta($id = 1) {
        // Notif
        $data["notifbimbingan"] = count($this->model('Mentor_model')->getNotifBimbingan($_SESSION['session']['username']));
        $data['notifaktivitas'] = count($this->model('Mentor_model')->getNotifAktivitas($_SESSION['session']['username']));

        // Pagination
        $dataperhal = 20;
        $data['jmlPeserta'] = count($this->model('Admin_model')->getAllPesertaByMentor($_SESSION['session']['username']));
        $data['jmlHalaman'] = ceil($data['jmlPeserta'] / $dataperhal);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($dataperhal * $data['hlmAktif']) - $dataperhal;
        $arr = [$data['awalData'], $dataperhal];

        if(!empty($_POST['keyword'])) {
            $data["peserta"] = $this->model('Mentor_model')->cariPesertaatMentor($_POST, [0, 60], $_SESSION['session']['username']);
        } else {
            $data["peserta"] = $this->model('Admin_model')->paginationPesertaatMentor($arr, $_SESSION['session']['username']);
        }

        $data["judul"] = "Mentor - Data Peserta";
        $this->view('templates/header', $data);
        $this->view('mentor/datapeserta', $data);
        $this->view('templates/footer');
    }

    public function detailpeserta($id = null) {
        // Notif
        $data["notifbimbingan"] = count($this->model('Mentor_model')->getNotifBimbingan($_SESSION['session']['username']));
        $data['notifaktivitas'] = count($this->model('Mentor_model')->getNotifAktivitas($_SESSION['session']['username']));

        $data["peserta"] = $this->model('Admin_model')->getPesertaById($id);
        $data["profilpeserta"] = $this->model('Peserta_model')->getProfilPeserta($data['peserta']['username']);
        
        if(empty($data['peserta'])) {
            header("Location: " . BASEURL . "/mentor/datapeserta");
            exit;
        }
        
        $data["mentormagang"] = $this->model('Admin_model')->getUsernameMentor($_SESSION['session']['username']);
        $data["judul"] = "Mentor - Detail Peserta";
        $this->view('templates/header', $data);
        $this->view('mentor/detailpeserta', $data);
        $this->view('templates/footer');
    }

    public function aktivitas($id = 1) {
        // Delete Notif Aktivitas
        $this->model('Mentor_model')->delNotifAktivitas($_SESSION['session']['username']);

        // Notif Bimbingan
        $data["notifbimbingan"] = count($this->model('Mentor_model')->getNotifBimbingan($_SESSION['session']['username']));

        // Pagination
        $dataperhal = 30;
        $data['jmlAktivitas'] = count($this->model('Mentor_model')->getAktivitasPeserta($_SESSION['session']['username']));
        $data['jmlHalaman'] = ceil($data['jmlAktivitas'] / $dataperhal);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($dataperhal * $data['hlmAktif']) - $dataperhal;
        $arr = [$data['awalData'], $dataperhal];

        if(!empty($_POST['keyword'])) {
            $data["aktivitas"] = $this->model('Mentor_model')->cariAktivitasPeserta($_POST, [0, 60], $_SESSION['session']['username']);
        } else {
            $data["aktivitas"] = $this->model('Mentor_model')->paginationAktivitasPeserta($arr, $_SESSION['session']['username']);
        }

        // Cari berdasarkan tanggal
        if(isset($_POST['caritanggal'])) {
            $tanggal = explode(' - ', $_POST['tanggalaktivitas']);
            $tanggalawal = $tanggal[0];
            $tanggalakhir = $tanggal[1];
            $data['aktivitas'] = $this->model('Mentor_model')->cariAktivitasPesertaByTanggal($_SESSION['session']['username'], [$tanggalawal, $tanggalakhir], [0, 30]);
        }

        // Acc aktivitas
        if(isset($_POST['accaktivitas'])) {
            if($this->model('Mentor_model')->accaktivitas($_POST) > 0) {
                Flasher::setFlash('Aktivitas disetujui', 'success');
                header("Location: " . BASEURL . '/mentor/aktivitas');
                exit;
            } else {    
                Flasher::setFlash('Aktivitas gagal disetujui', 'error');
                header("Location: " . BASEURL . '/mentor/aktivitas');
                exit;
            }
        }

        // Tolak aktivitas
        if(isset($_POST['tolakaktivitas'])) {
            if($this->model('Mentor_model')->tolakaktivitas($_POST) > 0) {
                Flasher::setFlash('Aktivitas ditolak', 'success');
                header("Location: " . BASEURL . '/mentor/aktivitas');
                exit;
            } else {    
                Flasher::setFlash('Aktivitas gagal ditolak', 'error');
                header("Location: " . BASEURL . '/mentor/aktivitas');
                exit;
            }
        }

        $data["judul"] = "Mentor - Aktivitas Peserta";
        $this->view('templates/header', $data);
        $this->view('mentor/aktivitas', $data);
        $this->view('templates/footer');
    }

    public function detailaktivitas($id) {
        // Notif
        $data["notifbimbingan"] = count($this->model('Mentor_model')->getNotifBimbingan($_SESSION['session']['username']));
        $data['notifaktivitas'] = count($this->model('Mentor_model')->getNotifAktivitas($_SESSION['session']['username']));

        $data["aktivitas"] = $this->model('Mentor_model')->getAktivitasdanProfilPeserta($id);

        if(empty($data['aktivitas'])) {
            header("Location: " . BASEURL . "/mentor/aktivitas");
            exit;
        }

        $data["judul"] = "Mentor - Detail Aktivitas Peserta";
        $this->view('templates/header', $data);
        $this->view('mentor/detailaktivitas', $data);
        $this->view('templates/footer');
    }

    public function absensi($id=1) {
        // Notif
        $data["notifbimbingan"] = count($this->model('Mentor_model')->getNotifBimbingan($_SESSION['session']['username']));
        $data['notifaktivitas'] = count($this->model('Mentor_model')->getNotifAktivitas($_SESSION['session']['username']));

        // Pagination
        $dataperhal = 30;
        $data['jmlAbsensi'] = count($this->model('Mentor_model')->getAbsensi($_SESSION['session']['username']));
        $data['jmlHalaman'] = ceil($data['jmlAbsensi'] / $dataperhal);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($dataperhal * $data['hlmAktif']) - $dataperhal;
        $arr = [$data['awalData'], $dataperhal];

        if(!empty($_POST['keyword'])) {
            $data["absensipeserta"] = $this->model('Mentor_model')->cariAbsensiPeserta($_POST, [0, 60], $_SESSION['session']['username']);
        } else {
            $data['absensipeserta'] = $this->model('Mentor_model')->getAbsensiWithPagination($arr, $_SESSION['session']['username']);
        }

        // Cari berdasarkan tanggal
        if(isset($_POST['caritanggal'])) {
            $tanggal = explode(' - ', $_POST['tanggalabsensi']);
            $tanggalawal = $tanggal[0];
            $tanggalakhir = $tanggal[1];
            $data['absensipeserta'] = $this->model('Mentor_model')->cariAbsensiPesertaByTanggal($_SESSION['session']['username'], [$tanggalawal, $tanggalakhir], [0, 45]);
        }

        
        $data["judul"] = "Mentor - Absensi Peserta";
        $this->view('templates/header', $data);
        $this->view('mentor/absensi', $data);
        $this->view('templates/footer');
    }

    public function detailabsensi($id) {
        // Notif
        $data["notifbimbingan"] = count($this->model('Mentor_model')->getNotifBimbingan($_SESSION['session']['username']));
        $data['notifaktivitas'] = count($this->model('Mentor_model')->getNotifAktivitas($_SESSION['session']['username']));

        $data['absensi'] = $this->model('Mentor_model')->getAbsensiById($id);
        if(empty($data['absensi'])) {
            header("Location: " . BASEURL . "/mentor/absensi");
            exit;
        }

        $data["judul"] = "Mentor - Detail Absensi Kehadiran";
        $this->view('templates/header', $data);
        $this->view('mentor/detailabsensi', $data);
        $this->view('templates/footer');
    }

    public function penilaian($id=1) {
        // Notif
        $data["notifbimbingan"] = count($this->model('Mentor_model')->getNotifBimbingan($_SESSION['session']['username']));
        $data['notifaktivitas'] = count($this->model('Mentor_model')->getNotifAktivitas($_SESSION['session']['username']));

        // Pagination
        $dataperhal = 30;
        $data['jmlPeserta'] = count($this->model('Admin_model')->getAllPesertaByMentor($_SESSION['session']['username']));
        $data['jmlHalaman'] = ceil($data['jmlPeserta'] / $dataperhal);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($dataperhal * $data['hlmAktif']) - $dataperhal;
        $arr = [$data['awalData'], $dataperhal];
        
        if(!empty($_POST['keyword'])) {
            $data['penilaian'] = $this->model('Mentor_model')->cariPenilaianPeserta($_POST, [0, 40], $_SESSION['session']['username']);
        } else {
            $data['penilaian'] = $this->model('Mentor_model')->getPenilaianPeserta($arr, $_SESSION['session']['username']);
        }

        $data["judul"] = "Mentor - Penilaian Peserta Magang";
        $this->view('templates/header', $data);
        $this->view('mentor/penilaian', $data);
        $this->view('templates/footer');
    }

    public function nilaipeserta($user) {
        // Notif
        $data["notifbimbingan"] = count($this->model('Mentor_model')->getNotifBimbingan($_SESSION['session']['username']));
        $data['notifaktivitas'] = count($this->model('Mentor_model')->getNotifAktivitas($_SESSION['session']['username']));

        $data['username_peserta'] = $this->model('Mentor_model')->getPesertaByUsn($user, $_SESSION['session']['username']);
        if(empty($data['username_peserta'])) {
            header("Location: " . BASEURL . '/mentor/penilaian');
            exit;
        } else {
            $checkUsername = $this->model('Peserta_model')->getPenilaianPesertaByUsn($data['username_peserta']['username']);
            if(!empty($checkUsername)) {
                header("Location: " . BASEURL . '/mentor/penilaian');
                exit;
            }
        }

        // Tombol Penilaian
        if(isset($_POST['tombolPenilaian'])) {
            $inputNumber = ['disiplin', 'kejujuran', 'etika', 'tanggungjawab', 'kerjatim', 'aktifdiskusi', 'komunikatif', 'ilmujurusan', 'penggunaansoftware', 'hasilkerja'];
            foreach($inputNumber as $input) {
                $nilai = floatval($_POST[$input]);
                if($nilai < 0 || $nilai > 100) {
                    Flasher::setFlash('Input nilai harus antara 0 sampai 100', 'info');
                    header("Location: " . BASEURL . '/mentor/nilaipeserta/' . $_POST['username_peserta']);
                    exit;
                }
            }

            if($this->model('Mentor_model')->addPenilaian($_POST, $data['username_peserta']) > 0) {
                Flasher::setFlash('Berhasil menginput nilai', 'success');
                header("Location: " . BASEURL . '/mentor/penilaian');
                exit;
            } else {
                Flasher::setFlash('Gagal menginput nilai', 'error');
                header("Location: " . BASEURL . '/mentor/penilaian');
                exit;
            }
        }

        $data["judul"] = "Mentor - Penilaian Peserta Magang";
        $this->view('templates/header', $data);
        $this->view('mentor/nilaipeserta', $data);
        $this->view('templates/footer');
    }

    public function detailnilaipeserta($id) {
        // Notif
        $data["notifbimbingan"] = count($this->model('Mentor_model')->getNotifBimbingan($_SESSION['session']['username']));
        $data['notifaktivitas'] = count($this->model('Mentor_model')->getNotifAktivitas($_SESSION['session']['username']));

        $data['penilaian'] = $this->model('Mentor_model')->getPenilaianPesertaById($id, $_SESSION['session']['username']);
        if(empty($data['penilaian'])) {
            header("Location: " . BASEURL . '/mentor/penilaian');
            exit;
        }

        $data['username_peserta'] = $this->model('Mentor_model')->getPesertaByUsn($data['penilaian']['username_peserta'], $_SESSION['session']['username']);

        $data["judul"] = "Mentor - Detail Penilaian Peserta";
        $this->view('templates/header', $data);
        $this->view('mentor/detailnilaipeserta', $data);
        $this->view('templates/footer');
    }

    public function laporan() {
        // Notif
        $data["notifbimbingan"] = count($this->model('Mentor_model')->getNotifBimbingan($_SESSION['session']['username']));
        $data['notifaktivitas'] = count($this->model('Mentor_model')->getNotifAktivitas($_SESSION['session']['username']));

        // Tombol laporan
        if(isset($_POST['tombollaporan'])) {
            $data['profilpeserta'] = $this->model('Peserta_model')->getUsername($_POST['namapeserta']);
            $data['periode'] = $_POST['periode'];
            $tanggal = explode(' - ', $data['periode']);
            $data['tanggalAwal'] = date('d-m-Y', strtotime(str_replace('/', '-', $tanggal[0])));
            $data['tanggalAkhir'] = date('d-m-Y', strtotime(str_replace('/', '-', $tanggal[1])));

            if($_POST['tipepencarian'] == 'absensi') {
                $data['laporan'] = 'Absensi';
                $data['absensi'] = $this->model('Mentor_model')->laporanabsensipeserta($_POST['namapeserta'], $_POST['periode'], $_SESSION['session']['username']);
            }

            if($_POST['tipepencarian'] == 'aktivitas') {
                $data['laporan'] = 'Aktivitas';
                $data['aktivitas'] = $this->model('Mentor_model')->laporanaktivitaspeserta($_POST['namapeserta'], $_POST['periode'], $_SESSION['session']['username']);
            }

        }

        $data['peserta'] = $this->model('Admin_model')->getAllPesertaByMentor($_SESSION['session']['username']);
        $data["judul"] = "Mentor - Laporan";
        $this->view('templates/header', $data);
        $this->view('mentor/laporan', $data);
        $this->view('templates/footer');
    }

    public function printabsensi() {
        if(empty($_POST['peserta']) && empty($_POST['periode'])) {
            header("Location: " . BASEURL . '/mentor/laporan');
            exit;
        }
        $tanggal = explode(' - ', $_POST['periode']);
        $data['tanggalAwal'] = date('d-m-Y', strtotime(str_replace('/', '-', $tanggal[0])));
        $data['tanggalAkhir'] = date('d-m-Y', strtotime(str_replace('/', '-', $tanggal[1])));

        $data['profilpeserta'] = $this->model('Peserta_model')->getUsername($_POST['peserta']);
        $data['absensi'] = $this->model('Mentor_model')->laporanabsensipeserta($_POST['peserta'], $_POST['periode'], $_SESSION['session']['username']);
        
        $data["judul"] = "Print Absensi";
        $this->view('mentor/printabsensi', $data);
    }

    public function printaktivitas() {
        if(empty($_POST['peserta']) && empty($_POST['periode'])) {
            header("Location: " . BASEURL . '/mentor/laporan');
            exit;
        }

        $tanggal = explode(' - ', $_POST['periode']);
        $data['tanggalAwal'] = date('d-m-Y', strtotime(str_replace('/', '-', $tanggal[0])));
        $data['tanggalAkhir'] = date('d-m-Y', strtotime(str_replace('/', '-', $tanggal[1])));

        $data['profilpeserta'] = $this->model('Peserta_model')->getUsername($_POST['peserta']);
        $data['aktivitas'] = $this->model('Mentor_model')->laporanaktivitaspeserta($_POST['peserta'], $_POST['periode'], $_SESSION['session']['username']);
        
        $data["judul"] = "Print Aktivitas";
        $this->view('mentor/printaktivitas', $data);
    }
}