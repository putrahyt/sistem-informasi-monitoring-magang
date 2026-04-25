<?php

class Peserta_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUsername($data) {
        $this->db->query("SELECT * FROM peserta WHERE username=:username");
        $this->db->bind('username', $data);
        return $this->db->single();
    }

    public function getUsernamePesertadanMentor($data) {
        $this->db->query("SELECT peserta.*, mentor.fullname FROM peserta LEFT JOIN mentor ON peserta.mentor_magang = mentor.username WHERE peserta.username=:username");
        $this->db->bind('username', $data);
        return $this->db->single();
    }

    public function getProfilPeserta($data) {
        $this->db->query("SELECT datadiripeserta.*, peserta.fullname_peserta, peserta.email FROM datadiripeserta JOIN peserta ON datadiripeserta.username = peserta.username WHERE peserta.username=:username");
        $this->db->bind('username', $data);
        return $this->db->single();
    }

    public function ubahProfilPeserta($data, $image) {
        $checkPeserta = $this->getProfilPeserta($_SESSION['session']['username']);
        
        if(empty($checkPeserta)) {
            $this->db->query("INSERT INTO datadiripeserta VALUES(:username, :tempat_lahir, :tanggal_lahir, :jenis_kelamin, :noHP, :alamat, :jurusan)");  
        } else {
            $this->db->query("UPDATE datadiripeserta SET username=:username, tempat_lahir=:tempat_lahir, tanggal_lahir=:tanggal_lahir, jenis_kelamin=:jenis_kelamin, noHP=:noHP, alamat=:alamat, jurusan=:jurusan WHERE username=:username");
        }
        
        $this->db->bind('username', $_SESSION['session']['username']);
        $this->db->bind('tempat_lahir', htmlspecialchars($data['tempatlahir']));
        $this->db->bind('tanggal_lahir', strtotime($data['tanggallahir']));
        $this->db->bind('jenis_kelamin', $data['jeniskelamin']);
        $this->db->bind('noHP', $data['phone']);
        $this->db->bind('alamat', htmlspecialchars($data['alamat']));
        $this->db->bind('jurusan', htmlspecialchars($data['jurusan']));
        $this->db->execute();
        $return1 = $this->db->rowCount();

        // update ke peserta
        $this->db->query("UPDATE peserta SET fullname_peserta=:fullname, email=:email, instansi=:instansi, image=:image WHERE username=:username");
        $this->db->bind('fullname', htmlspecialchars($data['fullname']));
        $this->db->bind('email', trim($data['email']));
        $this->db->bind('instansi', htmlspecialchars($data['instansi']));
        $this->db->bind('image', $image);
        $this->db->bind('username', $_SESSION['session']['username']);
        $this->db->execute();
        $return2 = $this->db->rowCount();

        return $return1+$return2;
    }

    public function ubahPassword($data) {
        $query = "UPDATE peserta SET password=:password WHERE username=:username";
        $this->db->query($query);
        $this->db->bind('password', password_hash($data['newpassword'], PASSWORD_DEFAULT));
        $this->db->bind('username', $_SESSION['session']['username']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function addPesan($data, $user) {
        $query = "INSERT INTO bimbingan VALUES(NULL, :pengirim, :penerima, :pesan, :tanggapan, :pesan_dilihat, :tanggapan_dibalas, :date_created_pesan, :date_created_tanggapan)";
        $this->db->query($query);
        $this->db->bind('pengirim', $user['username']);
        $this->db->bind('penerima', $user['mentor_magang']);
        $this->db->bind('pesan', htmlspecialchars($data['pesanBimbingan']));
        $this->db->bind('tanggapan', null);
        $this->db->bind('pesan_dilihat', 'belum');
        $this->db->bind('tanggapan_dibalas', 'belum');
        $this->db->bind('date_created_pesan', time());
        $this->db->bind('date_created_tanggapan', null);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getPesan($data) {
        $query = "SELECT * FROM bimbingan WHERE pengirim=:pengirim OR penerima=:penerima ORDER BY GREATEST(IFNULL(date_created_tanggapan, 0), date_created_pesan) DESC";
        $this->db->query($query);
        $this->db->bind('pengirim', $data);
        $this->db->bind('penerima', $data);
        return $this->db->resultSet();
    }

    public function getPesanWithPagination($arr, $data) {
        $query = "SELECT bimbingan.*, COALESCE(p_pengirim.fullname_peserta, m_pengirim.fullname) AS nama_pengirim, COALESCE(p_penerima.fullname_peserta, m_penerima.fullname) AS nama_penerima FROM bimbingan LEFT JOIN peserta p_pengirim ON bimbingan.pengirim = p_pengirim.username LEFT JOIN mentor m_pengirim ON bimbingan.pengirim = m_pengirim.username LEFT JOIN peserta p_penerima ON bimbingan.penerima = p_penerima.username LEFT JOIN mentor m_penerima ON bimbingan.penerima = m_penerima.username WHERE pengirim=:pengirim OR penerima=:penerima ORDER BY GREATEST(IFNULL(date_created_tanggapan, 0), date_created_pesan) DESC LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        $this->db->bind('pengirim', $data);
        $this->db->bind('penerima', $data);
        return $this->db->resultSet();
    }

    public function addTanggapan($data) {
        $query = "UPDATE bimbingan SET tanggapan=:tanggapan, date_created_tanggapan=:date_created_tanggapan, tanggapan_dibalas=:tanggapan_dibalas WHERE id_bimbingan=:id_bimbingan";
        $this->db->query($query);
        $this->db->bind('tanggapan', htmlspecialchars($data['pesanTanggapan']));
        $this->db->bind('date_created_tanggapan', time());
        $this->db->bind('tanggapan_dibalas', 'sudah');
        $this->db->bind('id_bimbingan', $data['id_bimbingan']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getNotifBimbingan($data) {
        $username = $this->getUsername($data);
        $query = "SELECT * FROM bimbingan WHERE (penerima=:penerima AND pesan_dilihat=:pesan_dilihat) OR (pengirim=:pengirim AND tanggapan_dibalas=:tanggapan_dibalas)";
        $this->db->query($query);
        $this->db->bind('penerima', $username['username']);
        $this->db->bind('pesan_dilihat', 'belum');
        $this->db->bind('pengirim', $username['username']);
        $this->db->bind('tanggapan_dibalas', 'sudah');
        return $this->db->resultSet();
    }

    public function delNotifBimbingan($data) {
        $username = $this->getUsername($data);
        $query1 = "UPDATE bimbingan SET pesan_dilihat=:pesan_dilihat WHERE penerima=:penerima AND pesan_dilihat = 'belum'";
        $this->db->query($query1);
        $this->db->bind('penerima', $username['username']);
        $this->db->bind('pesan_dilihat', 'sudah');
        $this->db->execute();

        $query2 = "UPDATE bimbingan SET tanggapan_dibalas=:tanggapan_dibalas WHERE pengirim=:pengirim AND tanggapan_dibalas = 'sudah'";
        $this->db->query($query2);
        $this->db->bind('pengirim', $username['username']);
        $this->db->bind('tanggapan_dibalas', null);
        $this->db->execute();
    }

    public function addaktivitas($data, $file, $user) {
        $query = "INSERT INTO aktivitas VALUES(NULL, :username_peserta, :status, :tanggal, :aktivitas, :catatan, :file_laporan, :link_laporan, :catatan_mentor, :mentor_magang, :is_seen)";
        $this->db->query($query);
        $this->db->bind('username_peserta', $user['username']);
        $this->db->bind('status', 0);
        $this->db->bind('tanggal', strtotime($data['tanggal']));
        $this->db->bind('aktivitas', htmlspecialchars($data['aktivitas']));
        $this->db->bind('catatan', htmlspecialchars($data['catatan']));
        $this->db->bind('file_laporan', $file);
        $this->db->bind('link_laporan', filter_var($data['urlaktivitas'], FILTER_SANITIZE_URL));
        $this->db->bind('catatan_mentor', null);
        $this->db->bind('mentor_magang', $user['mentor_magang']);
        $this->db->bind('is_seen', 0);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getAktivitasPeserta($data) {
        $query = "SELECT * FROM aktivitas WHERE username_peserta=:username_peserta";
        $this->db->query($query);
        $this->db->bind('username_peserta', $data);
        return $this->db->resultSet();
    }

    public function paginationAktivitasPeserta($arr, $data) {
        $query = "SELECT * FROM aktivitas WHERE username_peserta=:username_peserta ORDER BY tanggal DESC LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        $this->db->bind('username_peserta', $data);
        return $this->db->resultSet();
    }

    public function cariAktivitasPeserta($data, $arr, $user) {
        $query = "SELECT * FROM aktivitas WHERE aktivitas LIKE :keyword AND username_peserta=:username_peserta ORDER BY tanggal DESC LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        $this->db->bind('keyword', '%'.$data['keyword'].'%');
        $this->db->bind('username_peserta', $user);
        return $this->db->resultSet();
    }

    public function cariAktivitasPesertaByTanggal($user, $tanggal, $arr) {
        $tanggalawal = DateTime::createFromFormat('d/m/Y H:i:s', $tanggal[0]);
        $timestampawal = $tanggalawal->getTimestamp();
        $tanggalakhir = DateTime::createFromFormat('d/m/Y H:i:s', $tanggal[1]);
        $timestampakhir = $tanggalakhir->getTimestamp();
        
        $query = "SELECT * FROM aktivitas WHERE username_peserta=:username_peserta AND tanggal BETWEEN :timestampawal AND :timestampakhir ORDER BY tanggal DESC LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        $this->db->bind('username_peserta', $user);
        $this->db->bind('timestampawal', $timestampawal);
        $this->db->bind('timestampakhir', $timestampakhir);
        return $this->db->resultSet();
    }

    public function getAktivitasPesertaById($id) {
        $query = "SELECT * FROM aktivitas WHERE id_aktivitas=:id_aktivitas";
        $this->db->query($query);
        $this->db->bind('id_aktivitas', $id);
        return $this->db->single();
    }

    public function deleteAktivitasPeserta($aktivitas) {
        unlink('asset/img/fileaktivitas/' . $aktivitas['file_laporan']);

        $query = "DELETE FROM aktivitas WHERE id_aktivitas=:id_aktivitas";
        $this->db->query($query);
        $this->db->bind('id_aktivitas', $aktivitas['id_aktivitas']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function editaktivitas($data, $file, $aktivitas) {
        $query = "UPDATE aktivitas SET status=:status, tanggal=:tanggal, aktivitas=:aktivitas, catatan=:catatan, file_laporan=:file_laporan, link_laporan=:link_laporan, is_seen=:is_seen WHERE id_aktivitas=:id_aktivitas";
        $this->db->query($query);
        $this->db->bind('status', 0);
        $this->db->bind('tanggal', strtotime($data['tanggal']));
        $this->db->bind('aktivitas', htmlspecialchars($data['aktivitas']));
        $this->db->bind('catatan', htmlspecialchars($data['catatan']));
        $this->db->bind('file_laporan', $file);
        $this->db->bind('link_laporan', filter_var($data['urlaktivitas'], FILTER_SANITIZE_URL));
        $this->db->bind('is_seen', 0);
        $this->db->bind('id_aktivitas', $aktivitas['id_aktivitas']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getAbsensiByTanggal($user) {
        // $hariIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        // $bulanIndo = [
        //     1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        //     'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        // ];
        // $hari = $hariIndo[date('w', time())];
        // $tanggal = date('j', time());
        // $bulan = $bulanIndo[date('n', time())];
        // $tahun = date('Y', time());
        // $hasil = "$hari, $tanggal $bulan $tahun";
        $hasil = date('Y-m-d', time());

        $query = "SELECT * FROM absensi WHERE tanggal=:tanggal AND username_peserta=:username_peserta";
        $this->db->query($query);
        $this->db->bind('tanggal', $hasil);
        $this->db->bind('username_peserta', $user);
        return $this->db->single();
    }

    public function absensi($image, $data) {
        $user = $this->getUsername($data);
        $absensi = $this->getAbsensiByTanggal($data);
        // $hariIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        // $bulanIndo = [
        //     1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        //     'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        // ];
        // $hari = $hariIndo[date('w', time())];
        // $tanggal = date('j', time());
        // $bulan = $bulanIndo[date('n', time())];
        // $tahun = date('Y', time());
        // $hasil = "$hari, $tanggal $bulan $tahun";
        $hasil = date('Y-m-d', time());
        
        if(empty($absensi)) {
            $query1 = "INSERT INTO absensi VALUES(NULL, :username_peserta, :mentor_magang, :absen_masuk, :jam_masuk, :absen_pulang, :jam_pulang, :izin_absen, :bukti_izin, :img_absensi_masuk, :img_absensi_pulang, :tanggal)";
            $this->db->query($query1);
            $this->db->bind('username_peserta', $user['username']);
            $this->db->bind('mentor_magang', $user['mentor_magang']);
            $this->db->bind('absen_masuk', 'true');
            $this->db->bind('jam_masuk', time());
            $this->db->bind('absen_pulang', null);
            $this->db->bind('jam_pulang', null);
            $this->db->bind('izin_absen', null);
            $this->db->bind('bukti_izin', null);
            $this->db->bind('img_absensi_masuk', $image);
            $this->db->bind('img_absensi_pulang', null);
            $this->db->bind('tanggal', $hasil);
            $this->db->execute();
            return $this->db->rowCount();
        } else if($absensi['absen_masuk'] == 'true') {
            $query2 = "UPDATE absensi SET absen_pulang=:absen_pulang, jam_pulang=:jam_pulang, img_absensi_pulang=:img_absensi_pulang WHERE tanggal=:tanggal AND username_peserta=:username_peserta";
            $this->db->query($query2);
            $this->db->bind('absen_pulang', 'true');
            $this->db->bind('jam_pulang', time());
            $this->db->bind('img_absensi_pulang', $image);
            $this->db->bind('tanggal', $absensi['tanggal']);
            $this->db->bind('username_peserta', $user['username']);
            $this->db->execute();
            return $this->db->rowCount();
        }
    }

    public function getAbsensi($user) {
        $query = "SELECT * FROM absensi WHERE username_peserta=:username_peserta";
        $this->db->query($query);
        $this->db->bind('username_peserta', $user);
        return $this->db->resultSet();
    }

    public function getAbsensiById($id) {
        $query = "SELECT * FROM absensi WHERE id_absensi=:id_absensi";
        $this->db->query($query);
        $this->db->bind('id_absensi', $id);
        return $this->db->single();
    }

    public function getAbsensiWithPagination($arr, $user) {
        $query = "SELECT * FROM absensi WHERE username_peserta=:username_peserta ORDER BY tanggal DESC LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        $this->db->bind('username_peserta', $user);
        return $this->db->resultSet();
    }

    public function absensiTidakHadir($data, $file, $user) {
        $user = $this->getUsername($user);
        // $hariIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        // $bulanIndo = [
        //     1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        //     'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        // ];
        // $hari = $hariIndo[date('w', time())];
        // $tanggal = date('j', time());
        // $bulan = $bulanIndo[date('n', time())];
        // $tahun = date('Y', time());
        // $hasil = "$hari, $tanggal $bulan $tahun";
        $hasil = date('Y-m-d', time());

        $query = "INSERT INTO absensi VALUES(NULL, :username_peserta, :mentor_magang, :absen_masuk, :jam_masuk, :absen_pulang, :jam_pulang, :izin_absen, :bukti_izin, :img_absensi_masuk, :img_absensi_pulang, :tanggal)";
        $this->db->query($query);
        $this->db->bind('username_peserta', $user['username']);
        $this->db->bind('mentor_magang', $user['mentor_magang']);
        $this->db->bind('absen_masuk', 'false');
        $this->db->bind('jam_masuk', 0);
        $this->db->bind('absen_pulang', 'false');
        $this->db->bind('jam_pulang', 0);
        $this->db->bind('izin_absen', htmlspecialchars($data['alasan']));
        $this->db->bind('bukti_izin', $file);
        $this->db->bind('img_absensi_masuk', null);
        $this->db->bind('img_absensi_pulang', null);
        $this->db->bind('tanggal', $hasil);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getPenilaianPesertaByUsn($user) {
        $query = "SELECT * FROM penilaian WHERE username_peserta=:username_peserta";
        $this->db->query($query);
        $this->db->bind('username_peserta', $user);
        return $this->db->single();
    }
}