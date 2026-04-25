<?php

class Mentor_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    private function getUsername($data) {
        $query = "SELECT * FROM mentor WHERE username=:username";
        $this->db->query($query);
        $this->db->bind('username', $data);
        return $this->db->single();
    }

    public function getTotalPesertaByMentor($data) {
        $query = "SELECT mentor_magang, COUNT(*) AS total_peserta FROM peserta WHERE mentor_magang=:mentor_magang GROUP BY mentor_magang";
        $this->db->query($query);
        $this->db->bind('mentor_magang', $data);
        return $this->db->single();
    }

    public function ubahProfilMentor($data, $image) {
        $query = "UPDATE mentor SET fullname=:fullname, divisi=:divisi, jabatan=:jabatan, noHP=:noHP, email=:email, image=:image WHERE username=:username";
        $this->db->query($query);
        $this->db->bind('fullname', htmlspecialchars($data['fullname']));
        $this->db->bind('divisi', $data['divisi']);
        $this->db->bind('jabatan', htmlspecialchars($data['jabatan']));
        $this->db->bind('noHP', $data['phone']);
        $this->db->bind('email', trim($data['email']));
        $this->db->bind('image', $image);
        $this->db->bind('username', $_SESSION['session']['username']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahPassword($data) {
        $query = "UPDATE mentor SET password=:password WHERE username=:username";
        $this->db->query($query);
        $this->db->bind('password', password_hash($data['newpassword'], PASSWORD_DEFAULT));
        $this->db->bind('username', $_SESSION['session']['username']);
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
        $this->db->bind('id_bimbingan', $data['id_bimbingan']);
        $this->db->bind('date_created_tanggapan', time());
        $this->db->bind('tanggapan_dibalas', 'sudah');
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function addPesan($data, $user) {
        $query = "INSERT INTO bimbingan VALUES(NULL, :pengirim, :penerima, :pesan, :tanggapan, :pesan_dilihat, :tanggapan_dibalas, :date_created_pesan, :date_created_tanggapan)";
        $this->db->query($query);
        $this->db->bind('pengirim', $user);
        $this->db->bind('penerima', $data['kepadaPeserta']);
        $this->db->bind('pesan', htmlspecialchars($data['pesanBimbingan']));
        $this->db->bind('tanggapan', null);
        $this->db->bind('pesan_dilihat', 'belum');
        $this->db->bind('tanggapan_dibalas', 'belum');
        $this->db->bind('date_created_pesan', time());
        $this->db->bind('date_created_tanggapan', null);
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

    public function cariPesertaatMentor($data, $arr, $mentor) {
        $query = "SELECT * FROM peserta WHERE (fullname_peserta LIKE :keyword OR divisi_magang LIKE :keyword OR instansi LIKE :keyword) AND mentor_magang=:mentor_magang ORDER BY id_peserta desc LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        $this->db->bind('keyword', '%'.$data['keyword'].'%');
        $this->db->bind('mentor_magang', $mentor);
        return $this->db->resultSet();
    }  

    public function getAktivitasPeserta($data) {
        $query = "SELECT * FROM aktivitas WHERE mentor_magang=:mentor_magang ORDER BY tanggal DESC";
        $this->db->query($query);
        $this->db->bind('mentor_magang', $data);
        return $this->db->resultSet();
    }

    public function getAktivitasHariIni($data) {
        $query = "SELECT aktivitas.*, peserta.fullname_peserta FROM aktivitas LEFT JOIN peserta ON aktivitas.username_peserta = peserta.username WHERE aktivitas.mentor_magang=:mentor_magang AND aktivitas.tanggal BETWEEN UNIX_TIMESTAMP(CURDATE()) AND UNIX_TIMESTAMP(CURDATE() + INTERVAL 1 DAY) ORDER BY tanggal DESC";
        $this->db->query($query);
        $this->db->bind('mentor_magang', $data);
        return $this->db->resultSet();
    }

    public function paginationAktivitasPeserta($arr, $data) {
        $query = "SELECT aktivitas.*, peserta.fullname_peserta FROM aktivitas LEFT JOIN peserta ON aktivitas.username_peserta = peserta.username WHERE aktivitas.mentor_magang=:mentor_magang ORDER BY tanggal DESC LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        $this->db->bind('mentor_magang', $data);
        return $this->db->resultSet();
    }

    public function cariAktivitasPeserta($data, $arr, $user) {
        $query = "SELECT aktivitas.*, peserta.fullname_peserta FROM aktivitas LEFT JOIN peserta ON aktivitas.username_peserta = peserta.username WHERE (aktivitas.aktivitas LIKE :keyword OR peserta.fullname_peserta LIKE :keyword) AND aktivitas.mentor_magang=:mentor_magang ORDER BY tanggal DESC LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        $this->db->bind('keyword', '%'.$data['keyword'].'%');
        $this->db->bind('mentor_magang', $user);
        return $this->db->resultSet();
    }

    public function cariAktivitasPesertaByTanggal($user, $tanggal, $arr) {
        $tanggalawal = DateTime::createFromFormat('d/m/Y H:i:s', $tanggal[0]);
        $timestampawal = $tanggalawal->getTimestamp();
        $tanggalakhir = DateTime::createFromFormat('d/m/Y H:i:s', $tanggal[1]);
        $timestampakhir = $tanggalakhir->getTimestamp();
        
        $query = "SELECT aktivitas.*, peserta.fullname_peserta FROM aktivitas LEFT JOIN peserta ON aktivitas.username_peserta = peserta.username WHERE aktivitas.mentor_magang=:mentor_magang AND tanggal BETWEEN :timestampawal AND :timestampakhir ORDER BY tanggal DESC LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        $this->db->bind('mentor_magang', $user);
        $this->db->bind('timestampawal', $timestampawal);
        $this->db->bind('timestampakhir', $timestampakhir);
        return $this->db->resultSet();
    }

    public function getAktivitasdanProfilPeserta($id) {
        $query = "SELECT aktivitas.*, peserta.* FROM aktivitas LEFT JOIN peserta ON aktivitas.username_peserta = peserta.username WHERE aktivitas.id_aktivitas=:id_aktivitas";
        $this->db->query($query);
        $this->db->bind('id_aktivitas', $id);
        return $this->db->single();
    }

    public function accaktivitas($data) {
        $query = "UPDATE aktivitas SET catatan_mentor=:catatan_mentor, status=:status WHERE id_aktivitas=:id_aktivitas";
        $this->db->query($query);
        $this->db->bind('catatan_mentor', htmlspecialchars($data['catatan']));
        $this->db->bind('status', 1);
        $this->db->bind('id_aktivitas', $data['id_aktivitas']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function tolakaktivitas($data) {
        $query = "UPDATE aktivitas SET catatan_mentor=:catatan_mentor, status=:status WHERE id_aktivitas=:id_aktivitas";
        $this->db->query($query);
        $this->db->bind('catatan_mentor', htmlspecialchars($data['catatan']));
        $this->db->bind('status', 2);
        $this->db->bind('id_aktivitas', $data['id_aktivitas']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getNotifAktivitas($data) {
        $query = "SELECT * FROM aktivitas WHERE mentor_magang=:mentor_magang AND is_seen=:is_seen";
        $this->db->query($query);
        $this->db->bind('mentor_magang', $data);
        $this->db->bind('is_seen', 0);
        return $this->db->resultSet();
    }

    public function delNotifAktivitas($data) {
        $query = "UPDATE aktivitas SET is_seen=:is_seen WHERE mentor_magang=:mentor_magang";
        $this->db->query($query);
        $this->db->bind('is_seen', 1);
        $this->db->bind('mentor_magang', $data);
        $this->db->execute();
    }

    public function editcatatanmentor($data, $id) {
        $query = "UPDATE aktivitas SET catatan_mentor=:catatan_mentor WHERE id_aktivitas=:id_aktivitas";
        $this->db->query($query);
        $this->db->bind('catatan_mentor', htmlspecialchars($data['catatanmentor']));
        $this->db->bind('id_aktivitas', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getAbsensi($user) {
        $query = "SELECT * FROM absensi WHERE mentor_magang=:mentor_magang";
        $this->db->query($query);
        $this->db->bind('mentor_magang', $user);
        return $this->db->resultSet();
    }

    public function getAbsensiHariIni($user) {
        $query = "SELECT absensi.*, peserta.fullname_peserta, peserta.instansi FROM absensi LEFT JOIN peserta ON absensi.username_peserta = peserta.username WHERE absensi.mentor_magang=:mentor_magang AND absensi.tanggal=:tanggal ORDER BY absensi.tanggal DESC";
        $this->db->query($query);
        $this->db->bind('mentor_magang', $user);
        $this->db->bind('tanggal', date('Y-m-d', time()));
        return $this->db->resultSet();
    }

    public function getAbsensiWithPagination($arr, $user) {
        $query = "SELECT absensi.*, peserta.fullname_peserta, peserta.instansi FROM absensi LEFT JOIN peserta ON absensi.username_peserta = peserta.username WHERE absensi.mentor_magang=:mentor_magang ORDER BY absensi.tanggal DESC LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        $this->db->bind('mentor_magang', $user);
        return $this->db->resultSet();
    }
    
    public function cariAbsensiPeserta($data, $arr, $user) {
        $query = "SELECT absensi.*, peserta.fullname_peserta, peserta.instansi FROM absensi LEFT JOIN peserta ON absensi.username_peserta = peserta.username WHERE (peserta.fullname_peserta LIKE :keyword OR peserta.instansi LIKE :keyword) AND absensi.mentor_magang=:mentor_magang ORDER BY absensi.tanggal DESC LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        $this->db->bind('mentor_magang', $user);
        $this->db->bind('keyword', '%'.$data['keyword'].'%');
        return $this->db->resultSet();
    }

    public function getAbsensiById($id) {
        $query = "SELECT absensi.*, peserta.fullname_peserta, peserta.instansi, peserta.divisi_magang FROM absensi LEFT JOIN peserta ON absensi.username_peserta = peserta.username WHERE absensi.id_absensi=:id_absensi";
        $this->db->query($query);
        $this->db->bind('id_absensi', $id);
        return $this->db->single();
    }

    public function cariAbsensiPesertaByTanggal($user, $tanggal, $arr) {
        $tanggalAwal = date('Y-m-d', strtotime(str_replace('/', '-', $tanggal[0])));
        $tanggalAkhir = date('Y-m-d', strtotime(str_replace('/', '-', $tanggal[1])));
        // $tanggalawal = DateTime::createFromFormat('d/m/Y H:i:s', $tanggal[0]);
        // $timestampawal = $tanggalawal->getTimestamp();
        // $tanggalakhir = DateTime::createFromFormat('d/m/Y H:i:s', $tanggal[1]);
        // $timestampakhir = $tanggalakhir->getTimestamp();
        
        $query = "SELECT absensi.*, peserta.fullname_peserta, peserta.instansi FROM absensi LEFT JOIN peserta ON absensi.username_peserta = peserta.username WHERE absensi.mentor_magang=:mentor_magang AND absensi.tanggal BETWEEN :tanggalAwal AND :tanggalAkhir ORDER BY absensi.tanggal DESC LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        $this->db->bind('mentor_magang', $user);
        $this->db->bind('tanggalAwal', $tanggalAwal);
        $this->db->bind('tanggalAkhir', $tanggalAkhir);
        return $this->db->resultSet();
    }

    public function getPenilaianPeserta($arr, $user) {
        $query = "SELECT peserta.*, penilaian.* FROM peserta LEFT JOIN penilaian ON peserta.username = penilaian.username_peserta WHERE peserta.mentor_magang=:mentor_magang ORDER BY penilaian.username_peserta ASC LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        $this->db->bind('mentor_magang', $user);
        return $this->db->resultSet();
    }

    public function cariPenilaianPeserta($data, $arr, $user) {
        $query = "SELECT peserta.*, penilaian.* FROM peserta LEFT JOIN penilaian ON peserta.username = penilaian.username_peserta WHERE (peserta.fullname_peserta LIKE :keyword OR peserta.instansi LIKE :keyword OR peserta.divisi_magang LIKE :keyword) AND peserta.mentor_magang=:mentor_magang ORDER BY penilaian.username_peserta ASC LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        $this->db->bind('keyword', '%'.$data['keyword'].'%');
        $this->db->bind('mentor_magang', $user);
        return $this->db->resultSet();
    }

    public function getPesertaByUsn($peserta, $mentor) {
        $query = "SELECT * FROM peserta WHERE username=:username AND mentor_magang=:mentor_magang";
        $this->db->query($query);
        $this->db->bind('username', $peserta);
        $this->db->bind('mentor_magang', $mentor);
        return $this->db->single();
    }

    public function addPenilaian($data, $user) {
        $query = "INSERT INTO penilaian VALUES (NULL, :username_peserta, :mentor, :n_disiplin, :n_kejujuran, :n_etika, :n_tanggungjawab, :n_ilmujurusan, :n_penggunaansoftware, :n_hasilkerja, :n_kerjatim, :n_komunikatif, :n_aktifdiskusi)";
        $this->db->query($query);
        $this->db->bind('username_peserta', $user['username']);
        $this->db->bind('mentor', $user['mentor_magang']);
        $this->db->bind('n_disiplin', $data['disiplin']);
        $this->db->bind('n_kejujuran', $data['kejujuran']);
        $this->db->bind('n_etika', $data['etika']);
        $this->db->bind('n_tanggungjawab', $data['tanggungjawab']);
        $this->db->bind('n_ilmujurusan', $data['ilmujurusan']);
        $this->db->bind('n_penggunaansoftware', $data['penggunaansoftware']);
        $this->db->bind('n_hasilkerja', $data['hasilkerja']);
        $this->db->bind('n_kerjatim', $data['kerjatim']);
        $this->db->bind('n_komunikatif', $data['komunikatif']);
        $this->db->bind('n_aktifdiskusi', $data['aktifdiskusi']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getPenilaianPesertaById($id, $mentor) {
        $query = "SELECT * FROM penilaian WHERE id_penilaian=:id_penilaian AND mentor=:mentor";
        $this->db->query($query);
        $this->db->bind('id_penilaian', $id);
        $this->db->bind('mentor', $mentor);
        return $this->db->single();
    }

    public function laporanabsensipeserta($peserta, $periode, $mentor) {
        $tanggal = explode(' - ', $periode);
        $tanggalAwal = date('Y-m-d', strtotime(str_replace('/', '-', $tanggal[0])));
        $tanggalAkhir = date('Y-m-d', strtotime(str_replace('/', '-', $tanggal[1])));

        $query = "SELECT * FROM absensi WHERE (absensi.mentor_magang=:mentor_magang AND absensi.username_peserta=:username_peserta) AND absensi.tanggal BETWEEN :tanggalawal AND :tanggalakhir ORDER BY absensi.tanggal ASC";
        $this->db->query($query);
        $this->db->bind('mentor_magang', $mentor);
        $this->db->bind('username_peserta', $peserta);
        $this->db->bind('tanggalawal', $tanggalAwal);
        $this->db->bind('tanggalakhir', $tanggalAkhir);
        return $this->db->resultSet();
    }

    public function laporanaktivitaspeserta($peserta, $periode, $mentor) {
        $tanggal = explode(' - ', $periode);
        
        $tanggalawal = DateTime::createFromFormat('d/m/Y H:i:s', $tanggal[0]);
        $timestampawal = $tanggalawal->getTimestamp();
        $tanggalakhir = DateTime::createFromFormat('d/m/Y H:i:s', $tanggal[1]);
        $timestampakhir = $tanggalakhir->getTimestamp();
        
        $query = "SELECT * FROM aktivitas WHERE (aktivitas.mentor_magang=:mentor_magang AND aktivitas.username_peserta=:username_peserta) AND aktivitas.tanggal BETWEEN :timestampawal AND :timestampakhir ORDER BY tanggal ASC";
        $this->db->query($query);
        $this->db->bind('mentor_magang', $mentor);
        $this->db->bind('username_peserta', $peserta);
        $this->db->bind('timestampawal', $timestampawal);
        $this->db->bind('timestampakhir', $timestampakhir);
        return $this->db->resultSet();
    }
}