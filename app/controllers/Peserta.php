<?php
date_default_timezone_set('Asia/Jakarta');

class Peserta extends Controller {
    public function __construct()
    {
        Helper::is_logged_in();
    }

    public function index()
    {
        // Notif bimbingan
        $data["notifbimbingan"] = count($this->model('Peserta_model')->getNotifBimbingan($_SESSION['session']['username']));

        $data['totalaktivitas'] = count($this->model('Peserta_model')->getAktivitasPeserta($_SESSION['session']['username']));
        $data['penilaian'] = $this->model('Peserta_model')->getPenilaianPesertaByUsn($_SESSION['session']['username']);
        $data['aktivitas'] = $this->model('Peserta_model')->paginationAktivitasPeserta([0, 5], $_SESSION['session']['username']);
        $data['absensipeserta'] = $this->model('Peserta_model')->getAbsensiWithPagination([0, 5], $_SESSION['session']['username']);
        $data["judul"] = "Halaman Peserta";
        $this->view('templates/header', $data);
        $this->view('peserta/index', $data);
        $this->view('templates/footer');
    }

    public function profil()
    {
        // Notif bimbingan
        $data["notifbimbingan"] = count($this->model('Peserta_model')->getNotifBimbingan($_SESSION['session']['username']));

        $data["user"] = $this->model('Login_model')->getUsernamePeserta($_SESSION['session']['username']);
        $data["mentor"] = $this->model('Login_model')->getUsernameMentor($data["user"]["mentor_magang"]);

        // Tombol ubah profil
        if(isset($_POST['ubahdatadiri'])) {
            // validasi
            $checkEmail = $this->model('Login_model')->getEmailPeserta(trim($_POST['email']));
            if($checkEmail && ($checkEmail['email'] !== $data['user']['email'])) {
                Flasher::setFlash("Email tersebut sudah digunakan", "error");
                header("Location: " . BASEURL . "/peserta/profil");
                exit;
            } else if(!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
                Flasher::setFlash("Invalid email format", "error");
                header("Location: " . BASEURL . "/peserta/profil");
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
                    header("Location: " . BASEURL . "/peserta/profil");
                    exit;
                }

                // cek ekstensi
                $ekstensiValid = ["jpg","jpeg","png"];
                $explode = explode('.', $_FILES['gambar']['name']);
                $ekstensi = strtolower(end($explode));
                if( !in_array($ekstensi, $ekstensiValid) ) {
                    Flasher::setFlash('Masukkan file dengan ekstensi JPG, JPEG atau PNG', 'error');
                    header("Location: " . BASEURL . '/peserta/profil');
                    exit;
                }

                $image = uniqid() . '.' . $ekstensi;
                move_uploaded_file($_FILES["gambar"]["tmp_name"], 'asset/img/profil/' . $image);
                if($data['user']['image'] !== 'profile.jpg') {
                    unlink('asset/img/profil/' . $data['user']['image']);
                }
            }

            // Ubah profil
            if($this->model('Peserta_model')->ubahProfilPeserta($_POST, $image) > 0) {
                Flasher::setFlash('Data diri berhasil diubah', 'success');
                header("Location: " . BASEURL . '/peserta/profil');
                exit;
            }
            
        }

        // Tombol ubah password
        if(isset($_POST['changePassword'])) {
            if(password_verify($_POST['currentpassword'], $data['user']['password'])) {
                
                if(strlen($_POST['newpassword']) < 5) {
                    Flasher::setFlash('Password setidaknya minimal 5 karakter', 'error');
                    header("Location: " . BASEURL . '/peserta/profil');
                    exit;
                } else if($_POST['newpassword'] !== $_POST['renewpassword']) {
                    Flasher::setFlash('Password tidak sama', 'error');
                    header("Location: " . BASEURL . '/peserta/profil');
                    exit;
                }

                // Ubah password
                if($this->model('Peserta_model')->ubahPassword($_POST) > 0) {
                    Flasher::setFlash('Password berhasil diubah', 'success');
                    header("Location: " . BASEURL . '/peserta/profil');
                    exit;
                } else {
                    Flasher::setFlash('Password gagal diubah', 'error');
                    header("Location: " . BASEURL . '/peserta/profil');
                    exit;
                }

            } else {
                Flasher::setFlash('Password lama anda salah', 'error');
                header("Location: " . BASEURL . '/peserta/profil');
                exit;
            }
        }

        $data["profil"] = $this->model('Peserta_model')->getProfilPeserta($_SESSION['session']['username']);
        $data["judul"] = "Peserta - Halaman Profil";
        $this->view('templates/header', $data);
        $this->view('peserta/profil', $data);
        $this->view('templates/footer');
    }

    public function bimbingan($id = 1)
    {
        // Delete Notif bimbingan
        $this->model('Peserta_model')->delNotifBimbingan($_SESSION['session']['username']);

        $data["user"] = $this->model('Peserta_model')->getUsernamePesertadanMentor($_SESSION['session']['username']);

        // Pagination
        $dataperhal = 20;
        $data['jmlPesan'] = count($this->model('Peserta_model')->getPesan($data['user']['username']));
        $data['jmlHalaman'] = ceil($data['jmlPesan'] / $dataperhal);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($dataperhal * $data['hlmAktif']) - $dataperhal;
        $arr = [$data['awalData'], $dataperhal];

        $data["bimbingan"] = $this->model('Peserta_model')->getPesanWithPagination($arr, $data['user']['username']);
        
        // Add Tanggapan
        if(isset($_POST['tanggapan'])) {
            if($this->model('Peserta_model')->addTanggapan($_POST) > 0) {
                Flasher::setFlash('Berhasil mengirim tanggapan', 'success');
                header("Location: " . BASEURL . '/peserta/bimbingan');
                exit;
            } else {    
                Flasher::setFlash('Gagal mengirim tanggapan', 'error');
                header("Location: " . BASEURL . '/peserta/bimbingan');
                exit;
            }
        }

        // Add Pesan
        if(isset($_POST['pesan'])) {
            if($this->model('Peserta_model')->addPesan($_POST, $data['user']) > 0) {
                Flasher::setFlash('Berhasil mengirim pesan', 'success');
                header("Location: " . BASEURL . '/peserta/bimbingan');
                exit;
            } else {    
                Flasher::setFlash('Gagal mengirim pesan', 'error');
                header("Location: " . BASEURL . '/peserta/bimbingan');
                exit;
            }
        }

        $data["judul"] = "Peserta - Halaman Bimbingan";
        $this->view('templates/header', $data);
        $this->view('peserta/bimbingan', $data);
        $this->view('templates/footer');
    }

    public function aktivitas($id = 1) {
        // Notif bimbingan
        $data["notifbimbingan"] = count($this->model('Peserta_model')->getNotifBimbingan($_SESSION['session']['username']));

        // Pagination
        $dataperhal = 20;
        $data['jmlAktivitas'] = count($this->model('Peserta_model')->getAktivitasPeserta($_SESSION['session']['username']));
        $data['jmlHalaman'] = ceil($data['jmlAktivitas'] / $dataperhal);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($dataperhal * $data['hlmAktif']) - $dataperhal;
        $arr = [$data['awalData'], $dataperhal];

        if(!empty($_POST['keyword'])) {
            $data["aktivitas"] = $this->model('Peserta_model')->cariAktivitasPeserta($_POST, [0, 60], $_SESSION['session']['username']);
        } else {
            $data["aktivitas"] = $this->model('Peserta_model')->paginationAktivitasPeserta($arr, $_SESSION['session']['username']);
        }

        // Cari berdasarkan tanggal
        if(isset($_POST['caritanggal'])) {
            $tanggal = explode(' - ', $_POST['tanggalaktivitas']);
            $tanggalawal = $tanggal[0];
            $tanggalakhir = $tanggal[1];
            $data['aktivitas'] = $this->model('Peserta_model')->cariAktivitasPesertaByTanggal($_SESSION['session']['username'], [$tanggalawal, $tanggalakhir], [0, 30]);
        }

        $data["judul"] = "Peserta - Halaman Aktivitas";
        $this->view('templates/header', $data);
        $this->view('peserta/aktivitas', $data);
        $this->view('templates/footer');
    }

    public function addaktivitas() { 
        // Notif bimbingan
        $data["notifbimbingan"] = count($this->model('Peserta_model')->getNotifBimbingan($_SESSION['session']['username']));

        $data["user"] = $this->model('Login_model')->getUsernamePeserta($_SESSION['session']['username']);

        // Tambah aktivitas
        if(isset($_POST['tambahaktivitas'])) {
            // Jika ada url
            if(!empty($_POST['urlaktivitas'])) {
                if(!filter_var($_POST['urlaktivitas'], FILTER_VALIDATE_URL)) {
                    Flasher::setFlash('Masukkan url dengan lengkap. Contoh: https://youtube.com', 'error');
                    header("Location: " . BASEURL . '/peserta/addaktivitas');
                    exit;
                }
            }

            // Jika ada file
            if($_FILES['fileaktivitas']['error'] === 4) {
                $file = null;
            } else {
                // cek ekstensi
                $ekstensiValid = ["pdf","docx","doc","xlsx","xls","jpeg","jpg","png"];
                $explode = explode('.', $_FILES['fileaktivitas']['name']);
                $ekstensi = strtolower(end($explode));
                if( !in_array($ekstensi, $ekstensiValid) ) {
                    Flasher::setFlash('Masukkan file dengan ekstensi PDF, Word, Excel atau JPG!', 'error');
                    header("Location: " . BASEURL . '/peserta/addaktivitas');
                    exit;
                }

                // cek size
                if($_FILES["fileaktivitas"]["size"] > 2200000) {
                    Flasher::setFlash("Maksimal size file 2 Mb", "error");
                    header("Location: " . BASEURL . "/peserta/addaktivitas");
                    exit;
                }

                $file = $data['user']['fullname_peserta'] . '_' . uniqid() . '.' . $ekstensi;
                move_uploaded_file($_FILES["fileaktivitas"]["tmp_name"], 'asset/img/fileaktivitas/' . $file);
            }

            if($this->model('Peserta_model')->addaktivitas($_POST, $file, $data['user']) > 0) {
                Flasher::setFlash('Aktivitas berhasil ditambah', 'success');
                header("Location: " . BASEURL . '/peserta/addaktivitas');
                exit;
            } else {
                Flasher::setFlash('Aktivitas gagal ditambah', 'error');
                header("Location: " . BASEURL . '/peserta/addaktivitas');
                exit;
            }
        }

        $data["judul"] = "Peserta - Halaman Aktivitas";
        $this->view('templates/header', $data);
        $this->view('peserta/addaktivitas', $data);
        $this->view('templates/footer');
    }

    public function deleteaktivitas($id) {
        $aktivitas = $this->model('Peserta_model')->getAktivitasPesertaById($id);

        if(empty($aktivitas)) {
            header("Location: " . BASEURL . "/peserta/aktivitas");
            exit;
        }

        if($this->model('Peserta_model')->deleteAktivitasPeserta($aktivitas) > 0) {
            Flasher::setFlash('Aktivitas berhasil dihapus', 'success');
            header("Location: " . BASEURL . '/peserta/aktivitas');
            exit;
        } else {
            Flasher::setFlash('Aktivitas gagal dihapus', 'error');
            header("Location: " . BASEURL . '/peserta/aktivitas');
            exit;
        }
    }

    public function detailaktivitas($id) {
        // Notif bimbingan
        $data["notifbimbingan"] = count($this->model('Peserta_model')->getNotifBimbingan($_SESSION['session']['username']));

        $data['aktivitas'] = $this->model('Peserta_model')->getAktivitasPesertaById($id);

        if(empty($data['aktivitas'])) {
            header("Location: " . BASEURL . "/peserta/aktivitas");
            exit;
        }

        $data["judul"] = "Peserta - Detail Aktivitas";
        $this->view('templates/header', $data);
        $this->view('peserta/detailaktivitas', $data);
        $this->view('templates/footer');
    }

    public function editaktivitas($id) {
        // Notif bimbingan
        $data["notifbimbingan"] = count($this->model('Peserta_model')->getNotifBimbingan($_SESSION['session']['username']));

        $data['aktivitas'] = $this->model('Peserta_model')->getAktivitasPesertaById($id);
        if(empty($data['aktivitas'])) {
            header("Location: " . BASEURL . "/peserta/aktivitas");
            exit;
        }

        $data['user'] = $this->model('Login_model')->getUsernamePeserta($data['aktivitas']['username_peserta']);

        // Edit aktivitas
        if(isset($_POST['editaktivitas'])) {
            // Jika ada url
            if(!empty($_POST['urlaktivitas'])) {
                if(!filter_var($_POST['urlaktivitas'], FILTER_VALIDATE_URL)) {
                    Flasher::setFlash('Masukkan url dengan lengkap. Contoh: https://youtube.com', 'error');
                    header("Location: " . BASEURL . '/peserta/editaktivitas/' . $id);
                    exit;
                }
            }

            // Jika ada file
            if($_FILES['fileaktivitas']['error'] === 4) {
                if(!empty($data['aktivitas']['file_laporan'])) {
                    $file = $data['aktivitas']['file_laporan'];
                } else {
                    $file = null;
                }
            } else {
                // cek ekstensi
                $ekstensiValid = ["pdf","docx","doc","xlsx","xls","jpeg","jpg","png"];
                $explode = explode('.', $_FILES['fileaktivitas']['name']);
                $ekstensi = strtolower(end($explode));
                if( !in_array($ekstensi, $ekstensiValid) ) {
                    Flasher::setFlash('Masukkan file dengan ekstensi PDF, Word, Excel atau JPG!', 'error');
                    header("Location: " . BASEURL . '/peserta/editaktivitas/' . $id);
                    exit;
                }

                // cek size
                if($_FILES["fileaktivitas"]["size"] > 2200000) {
                    Flasher::setFlash("Maksimal size file 2 Mb", "error");
                    header("Location: " . BASEURL . '/peserta/editaktivitas/' . $id);
                    exit;
                }

                $file = $data['user']['fullname_peserta'] . '_' . uniqid() . '.' . $ekstensi;
                move_uploaded_file($_FILES["fileaktivitas"]["tmp_name"], 'asset/img/fileaktivitas/' . $file);
                unlink('asset/img/fileaktivitas/' . $data['aktivitas']['file_laporan']);
            }

            if($this->model('Peserta_model')->editaktivitas($_POST, $file, $data['aktivitas']) > 0) {
                Flasher::setFlash('Aktivitas berhasil diubah', 'success');
                header("Location: " . BASEURL . '/peserta/aktivitas');
                exit;
            } else {
                header("Location: " . BASEURL . '/peserta/aktivitas');
                exit;
            }

        }

        $data["judul"] = "Peserta - Detail Aktivitas";
        $this->view('templates/header', $data);
        $this->view('peserta/editaktivitas', $data);
        $this->view('templates/footer');
    }

    public function absensi($id=1) {
        // Notif bimbingan
        $data["notifbimbingan"] = count($this->model('Peserta_model')->getNotifBimbingan($_SESSION['session']['username']));

        // Pagination
        $dataperhal = 20;
        $data['jmlAbsensi'] = count($this->model('Peserta_model')->getAbsensi($_SESSION['session']['username']));
        $data['jmlHalaman'] = ceil($data['jmlAbsensi'] / $dataperhal);
        $data['hlmAktif'] = $id;
        $data['awalData'] = ($dataperhal * $data['hlmAktif']) - $dataperhal;
        $arr = [$data['awalData'], $dataperhal];

        $data['absensipeserta'] = $this->model('Peserta_model')->getAbsensiWithPagination($arr, $_SESSION['session']['username']);


        // Tombol Tidak Hadir
        if(isset($_POST['tombolTidakHadir'])) {
            $data['dataabsen'] = $this->model('Peserta_model')->getAbsensiByTanggal($_SESSION['session']['username']);
            if(!empty($data['dataabsen'])) {
                Flasher::setFlash('Anda sudah melakukan absensi hari ini', 'info');
                header("Location: " . BASEURL . '/peserta/absensi');
                exit;
            }

            $waktusekarang = date('H:i');
            $waktumulai = '07:00';
            $waktuselesai = '19:30';
            if($waktusekarang < $waktumulai || $waktusekarang > $waktuselesai) {
                Flasher::setFlash('Absensi dilakukan dari pukul 07:00 - 19:30', 'info');
                header("Location: " . BASEURL . '/peserta/absensi');
                exit;
            }

            // Jika ada file
            if($_FILES['filependukung']['error'] === 4) {
                $file = null;
            } else {
                // cek ekstensi
                $ekstensiValid = ["pdf"];
                $explode = explode('.', $_FILES['filependukung']['name']);
                $ekstensi = strtolower(end($explode));
                if( !in_array($ekstensi, $ekstensiValid) ) {
                    Flasher::setFlash('Masukkan file dengan ekstensi PDF!', 'error');
                    header("Location: " . BASEURL . '/peserta/absensi');
                    exit;
                }

                // cek size
                if($_FILES["filependukung"]["size"] > 1200000) {
                    Flasher::setFlash("Maksimal size file 1 Mb", "error");
                    header("Location: " . BASEURL . "/peserta/absensi");
                    exit;
                }

                $data["user"] = $this->model('Login_model')->getUsernamePeserta($_SESSION['session']['username']);
                $file = $data['user']['fullname_peserta'] . '_File Pendukung_' . uniqid() . '.' . $ekstensi;
                move_uploaded_file($_FILES["filependukung"]["tmp_name"], 'asset/img/absen/filetidakhadir/' . $file);
            }

            if($this->model('Peserta_model')->absensiTidakHadir($_POST, $file, $_SESSION['session']['username']) > 0) {
                Flasher::setFlash('Berhasil melakukan absensi', 'success');
                header("Location: " . BASEURL . '/peserta/absensi');
                exit;
            } else {
                Flasher::setFlash('Gagal melakukan absensi', 'success');
                header("Location: " . BASEURL . '/peserta/absensi');
                exit;
            }
        }

        $data["judul"] = "Peserta - Absensi";
        $this->view('templates/header', $data);
        $this->view('peserta/absensi', $data);
        $this->view('templates/footer');
    }

    public function absensikehadiran() {
        if(empty($_POST['absensi'])) {
            header("Location: " . BASEURL . '/peserta/absensi');
            exit;
        }

        // Notif bimbingan
        $data["notifbimbingan"] = count($this->model('Peserta_model')->getNotifBimbingan($_SESSION['session']['username']));

        // Cek waktu absensi masuk dan pulang
        $data['dataabsen'] = $this->model('Peserta_model')->getAbsensiByTanggal($_SESSION['session']['username']);
        $waktusekarang = date('H:i');
        $waktumulai = '07:00';
        $waktuselesai = '19:30';
        if($waktusekarang < $waktumulai || $waktusekarang > $waktuselesai) {
            Flasher::setFlash('Absensi dilakukan dari pukul 07:00 - 19:30', 'info');
            header("Location: " . BASEURL . '/peserta/absensi');
            exit;
        } else {
            if($_POST['absensi'] === "masuk") {
                if(!empty($data['dataabsen'])) {
                    Flasher::setFlash('Anda sudah melakukan absensi masuk hari ini', 'info');
                    header("Location: " . BASEURL . '/peserta/absensi');
                    exit;
                }
            } else if($_POST['absensi'] === "pulang") {  
                if(empty($data['dataabsen'])) {
                    Flasher::setFlash('Anda belum melakukan absensi masuk. Silahkan melakukan absensi terlebih dahulu', 'info');
                    header("Location: " . BASEURL . '/peserta/absensi');
                    exit;
                } else if($data['dataabsen']['absen_pulang'] == 'true' || $data['dataabsen']['absen_pulang'] == 'false') {
                    Flasher::setFlash('Anda sudah melakukan absensi hari ini', 'info');
                    header("Location: " . BASEURL . '/peserta/absensi');
                    exit;
                }
            }
        }

        // Tombol Absensi
        if(isset($_POST['btnAbsen'])) {
            if(!isset($_POST['fotoInput'], $_POST['latitude'], $_POST['longitude'])) {
                Flasher::setFlash('Data tidak lengkap', 'error');
                header("Location: " . BASEURL . '/peserta/absensi');
                exit;
            }

            $fotoData = $_POST['fotoInput'];
            if (strpos($fotoData, 'data:image/jpeg;base64,') !== 0) {
                Flasher::setFlash('Format gambar tidak valid', 'error');
                header("Location: " . BASEURL . '/peserta/absensi');
                exit;
            }

            $imgdata = base64_decode(str_replace('data:image/jpeg;base64,', '', $fotoData));
            $finfo = finfo_open();
            $mime = finfo_buffer($finfo, $imgdata, FILEINFO_MIME_TYPE);
            finfo_close($finfo);
            if ($mime !== 'image/jpeg') {
                Flasher::setFlash('File bukan gambar JPEG', 'error');
                header("Location: " . BASEURL . '/peserta/absensi');
                exit;
            }

            $folder = realpath(__DIR__ . '/../../asset/img/absen');
            $namafile = $folder . '/absen_' . $_POST['absensi'] . '_' . $_SESSION['session']['username'] . '_' . date('Ymd_His') . '.jpeg';
            
            // Masukkan ke DB
            if($this->model('Peserta_model')->absensi(basename($namafile), $_SESSION['session']['username']) > 0) {
                file_put_contents($namafile, $imgdata);
                Flasher::setFlash('Berhasil melakukan absensi ' . $_POST['absensi'], 'success');
                header("Location: " . BASEURL . '/peserta/absensi');
                exit;
            } else {
                Flasher::setFlash('Gagal melakukan absensi', 'success');
                header("Location: " . BASEURL . '/peserta/absensi');
                exit;
            }
            

        }

        $data['absensi'] = $_POST['absensi'];
        $data['koordinat'] = $this->model('Admin_model')->getKoordinat();
        $data["judul"] = "Peserta - Absensi Kehadiran";
        $this->view('templates/header', $data);
        $this->view('peserta/absensikehadiran', $data);
        $this->view('templates/footer');
    }

    public function detailabsensi($id) {
        // Notif bimbingan
        $data["notifbimbingan"] = count($this->model('Peserta_model')->getNotifBimbingan($_SESSION['session']['username']));

        $data['absensi'] = $this->model('Peserta_model')->getAbsensiById($id);
        if(empty($data['absensi'])) {
            header("Location: " . BASEURL . "/peserta/absensi");
            exit;
        }

        $data["judul"] = "Peserta - Detail Absensi Kehadiran";
        $this->view('templates/header', $data);
        $this->view('peserta/detailabsensi', $data);
        $this->view('templates/footer');
    }

    public function penilaian() {
        // Notif bimbingan
        $data["notifbimbingan"] = count($this->model('Peserta_model')->getNotifBimbingan($_SESSION['session']['username']));

        $data['penilaian'] = $this->model('Peserta_model')->getPenilaianPesertaByUsn($_SESSION['session']['username']);
        $data['username_peserta'] = $this->model('Peserta_model')->getUsername($_SESSION['session']['username']);
        $data["judul"] = "Peserta - Penilaian Magang";
        $this->view('templates/header', $data);
        $this->view('peserta/penilaian', $data);
        $this->view('templates/footer');
    }

    public function printabsensi($user = null) {
        $data['user'] = $this->model('Peserta_model')->getUsername(base64_decode($user));
        if(empty($data['user'])) {
            header("Location: " . BASEURL . '/peserta/absensi');
            exit;
        }

        $data['mentor'] = $this->model('Peserta_model')->getUsernamePesertadanMentor($data['user']['username']);
        $data['absensi'] = $this->model('Peserta_model')->getAbsensi($_SESSION['session']['username']);
        $data["judul"] = "Print Absensi";
        $this->view('peserta/printabsensi', $data);
    }

    public function printaktivitas($user = null) {
        $data['user'] = $this->model('Peserta_model')->getUsername(base64_decode($user));
        if(empty($data['user'])) {
            header("Location: " . BASEURL . '/peserta/aktivitas');
            exit;
        }

        $data['mentor'] = $this->model('Peserta_model')->getUsernamePesertadanMentor($data['user']['username']);
        $data['aktivitas'] = $this->model('Peserta_model')->getAktivitasPeserta($_SESSION['session']['username']);
        $data["judul"] = "Print Aktivitas";
        $this->view('peserta/printaktivitas', $data);
    }

    public function printpenilaian($user = null) {
        $data['user'] = $this->model('Peserta_model')->getUsername(base64_decode($user));
        if(empty($data['user'])) {
            header("Location: " . BASEURL . '/peserta/aktivitas');
            exit;
        }

        $data['mentor'] = $this->model('Peserta_model')->getUsernamePesertadanMentor($data['user']['username']);
        $data['penilaian'] = $this->model('Peserta_model')->getPenilaianPesertaByUsn($_SESSION['session']['username']);
        $data["judul"] = "Print Penilaian";
        $this->view('peserta/printpenilaian', $data);
    }

}