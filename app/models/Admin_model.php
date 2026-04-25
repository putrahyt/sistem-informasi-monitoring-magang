<?php

class Admin_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Admin
    public function getUsernameAdmin($data) {
        $this->db->query("SELECT * FROM admin WHERE username=:username");
        $this->db->bind('username', $data);
        return $this->db->single();
    }

    public function ubahPassword($data) {
        $this->db->query("UPDATE admin SET password=:password WHERE username=:username");
        $this->db->bind('password', password_hash($data['password1'], PASSWORD_DEFAULT));
        $this->db->bind('username', $_SESSION['session']['username']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahEmailorUsername($data) {
        $this->db->query("UPDATE admin SET email=:email, username=:username_new WHERE username=:username_old");
        $this->db->bind('email', trim($data['email']));
        $this->db->bind('username_new', strtolower(stripslashes(htmlspecialchars($data['username']))));
        $this->db->bind('username_old', $_SESSION['session']['username']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getKoordinat() {
        $this->db->query("SELECT * FROM pengaturan");
        return $this->db->single();
    }

    public function ubahKoordinat($data, $id) {
        $query = "UPDATE pengaturan SET latitude=:latitude, longitude=:longitude, jarak=:jarak WHERE id_pengaturan=:id_pengaturan";
        $this->db->query($query);
        $this->db->bind('latitude', $data['latitude']);
        $this->db->bind('longitude', $data['longitude']);
        $this->db->bind('jarak', $data['jarak']);
        $this->db->bind('id_pengaturan', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // Data Mentor
    public function getUsernameMentor($data) {
        $this->db->query("SELECT * FROM mentor WHERE username=:username");
        $this->db->bind('username', $data);
        return $this->db->single();
    }

    public function addMentor($data) {
        $query = "INSERT INTO mentor VALUES (NULL, :fullname, :username, :password, :email, :noHP, :jabatan, :divisi, :date_created, :image, :role, :reset_token_hash, :reset_token_expires_at)";
        $this->db->query($query);
        $this->db->bind('fullname', htmlspecialchars($data['fullname']));
        $this->db->bind('username', strtolower(stripslashes(htmlspecialchars($data['username']))));
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind('email', null);
        $this->db->bind('noHP', null);
        $this->db->bind('jabatan', null);
        $this->db->bind('divisi', null);
        $this->db->bind('date_created', time());
        $this->db->bind('image', "profile.jpg");
        $this->db->bind('role', "mentor");
        $this->db->bind('reset_token_hash', null);
        $this->db->bind('reset_token_expires_at', null);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getAllMentor() {
        $query = "SELECT * FROM mentor";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function deleteMentor($id) {
        $image = $this->getMentorById($id);
        $image['image'] !== 'profile.jpg' && unlink('asset/img/profil/' . $image['image']);

        $query = "DELETE FROM mentor WHERE id_mentor=:id_mentor";
        $this->db->query($query);
        $this->db->bind('id_mentor', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getMentorById($id) {
        $this->db->query("SELECT * FROM mentor WHERE id_mentor=:id_mentor");
        $this->db->bind('id_mentor', $id);
        $this->db->execute();
        return $this->db->single();
    }

    public function ubahMentor($data, $user) {
        $peserta = $this->getPesertaByUsrMentor($user);
        if(!empty($peserta)) {
            $query = "UPDATE peserta SET mentor_magang=:mentor_magang WHERE mentor_magang=:username";
            $this->db->query($query);
            $this->db->bind('mentor_magang', strtolower(stripslashes(htmlspecialchars($data["username"]))));
            $this->db->bind('username', $user);
            $this->db->execute();
        }

        $query = "UPDATE mentor SET fullname=:fullname, username=:username WHERE id_mentor=:id_mentor";
        $this->db->query($query);
        $this->db->bind('fullname', htmlspecialchars($data["fullname"]));
        $this->db->bind('username', strtolower(stripslashes(htmlspecialchars($data["username"]))));
        $this->db->bind('id_mentor', $data["id_mentor"]);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahPasswordMentor($data) {
        $query = "UPDATE mentor SET password=:password WHERE id_mentor=:id_mentor";
        $this->db->query($query);
        $this->db->bind('password', password_hash($data['password1'], PASSWORD_DEFAULT));
        $this->db->bind('id_mentor', $data['id_mentor']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cariMentor($data, $arr) {
        $query = "SELECT * FROM mentor WHERE fullname LIKE :keyword OR username LIKE :keyword ORDER BY id_mentor desc LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        $this->db->bind('keyword', '%'.$data['keyword'].'%');
        return $this->db->resultSet();
    }   

    public function paginationMentor($arr) {
        $query = "SELECT * FROM mentor ORDER BY id_mentor desc LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    // Peserta
    public function getPesertaByUsrMentor($data) {
        $query = "SELECT * FROM peserta WHERE mentor_magang=:mentor_magang";
        $this->db->query($query);
        $this->db->bind('mentor_magang', strtolower(stripslashes(htmlspecialchars($data))));
        return $this->db->resultSet();
    }

    public function getAllPeserta() {
        $query = "SELECT * FROM peserta";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getAllPesertaByMentor($data) {
        $query = "SELECT * FROM peserta WHERE mentor_magang=:mentor_magang";
        $this->db->query($query);
        $this->db->bind('mentor_magang', $data);
        return $this->db->resultSet();
    }
    
    public function paginationPeserta($arr) {
        $query = "SELECT * FROM peserta ORDER BY id_peserta desc LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function paginationPesertaatMentor($arr, $data) {
        $query = "SELECT * FROM peserta WHERE mentor_magang=:mentor_magang ORDER BY id_peserta desc LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        $this->db->bind('mentor_magang', $data);
        return $this->db->resultSet();
    }

    public function cariPeserta($data, $arr) {
        $query = "SELECT * FROM peserta WHERE fullname_peserta LIKE :keyword OR instansi LIKE :keyword OR divisi_magang LIKE :keyword ORDER BY id_peserta desc LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        $this->db->bind('keyword', '%'.$data['keyword'].'%');
        return $this->db->resultSet();
    }  

    public function cariPesertaatMentor($data, $arr, $mentor) {
        $query = "SELECT * FROM peserta WHERE (fullname_peserta LIKE :keyword OR username LIKE :keyword) AND mentor_magang=:mentor_magang ORDER BY id_peserta desc LIMIT $arr[0], $arr[1]";
        $this->db->query($query);
        $this->db->bind('keyword', '%'.$data['keyword'].'%');
        $this->db->bind('mentor_magang', $mentor);
        return $this->db->resultSet();
    }   

    public function getPesertaById($id) {
        $this->db->query("SELECT * FROM peserta WHERE id_peserta=:id_peserta");
        $this->db->bind('id_peserta', $id);
        $this->db->execute();
        return $this->db->single();
    }

    public function deletePeserta($peserta, $datadiripeserta, $absensi, $aktivitas, $bimbingan, $penilaian) {
        $peserta['image'] !== 'profile.jpg' && unlink('asset/img/profil/' . $peserta['image']);
        if(!empty($datadiripeserta)) {
            $this->db->query("DELETE FROM datadiripeserta WHERE username=:username");
            $this->db->bind('username', $datadiripeserta['username']);
            $this->db->execute();
            $return1 = $this->db->rowCount();
        }

        if(!empty($absensi)) {
            $this->db->query("DELETE FROM absensi WHERE username_peserta=:username");
            $this->db->bind('username', $peserta['username']);
            $this->db->execute();
            $return2 = $this->db->rowCount();
        }

        if(!empty($aktivitas)) {
            $this->db->query("DELETE FROM aktivitas WHERE username_peserta=:username");
            $this->db->bind('username', $peserta['username']);
            $this->db->execute();
            $return3 = $this->db->rowCount();
        }

        if(!empty($bimbingan)) {
            $this->db->query("DELETE FROM bimbingan WHERE pengirim=:pengirim OR penerima=:penerima");
            $this->db->bind('pengirim', $peserta['username']);
            $this->db->bind('penerima', $peserta['username']);
            $this->db->execute();
            $return4 = $this->db->rowCount();
        }

        if(!empty($penilaian)) {
            $this->db->query("DELETE FROM penilaian WHERE username_peserta=:username");
            $this->db->bind('username', $peserta['username']);
            $this->db->execute();
            $return5 = $this->db->rowCount();
        }

        $query = "DELETE FROM peserta WHERE id_peserta=:id_peserta";
        $this->db->query($query);
        $this->db->bind('id_peserta', $peserta['id_peserta']);
        $this->db->execute();
        $return6 = $this->db->rowCount();

        return $return1+$return2+$return3+$return4+$return5+$return6;
    }

    public function getAktivitasHariIni() {
        $query = "SELECT aktivitas.*, peserta.fullname_peserta, mentor.fullname FROM aktivitas LEFT JOIN peserta ON aktivitas.username_peserta = peserta.username LEFT JOIN mentor ON aktivitas.mentor_magang = mentor.username WHERE aktivitas.tanggal BETWEEN UNIX_TIMESTAMP(CURDATE()) AND UNIX_TIMESTAMP(CURDATE() + INTERVAL 1 DAY) ORDER BY tanggal DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getAbsensiHariIni() {
        $query = "SELECT absensi.*, peserta.fullname_peserta, peserta.instansi FROM absensi LEFT JOIN peserta ON absensi.username_peserta = peserta.username WHERE absensi.tanggal=:tanggal ORDER BY absensi.tanggal DESC";
        $this->db->query($query);
        $this->db->bind('tanggal', date('Y-m-d', time()));
        return $this->db->resultSet();
    }

    public function laporanabsensipeserta($peserta, $periode) {
        $tanggal = explode(' - ', $periode);
        $tanggalAwal = date('Y-m-d', strtotime(str_replace('/', '-', $tanggal[0])));
        $tanggalAkhir = date('Y-m-d', strtotime(str_replace('/', '-', $tanggal[1])));

        $query = "SELECT * FROM absensi WHERE absensi.username_peserta=:username_peserta AND absensi.tanggal BETWEEN :tanggalawal AND :tanggalakhir ORDER BY absensi.tanggal ASC";
        $this->db->query($query);
        $this->db->bind('username_peserta', $peserta);
        $this->db->bind('tanggalawal', $tanggalAwal);
        $this->db->bind('tanggalakhir', $tanggalAkhir);
        return $this->db->resultSet();
    }

    public function laporanaktivitaspeserta($peserta, $periode) {
        $tanggal = explode(' - ', $periode);
        
        $tanggalawal = DateTime::createFromFormat('d/m/Y H:i:s', $tanggal[0]);
        $timestampawal = $tanggalawal->getTimestamp();
        $tanggalakhir = DateTime::createFromFormat('d/m/Y H:i:s', $tanggal[1]);
        $timestampakhir = $tanggalakhir->getTimestamp();
        
        $query = "SELECT * FROM aktivitas WHERE aktivitas.username_peserta=:username_peserta AND aktivitas.tanggal BETWEEN :timestampawal AND :timestampakhir ORDER BY tanggal ASC";
        $this->db->query($query);
        $this->db->bind('username_peserta', $peserta);
        $this->db->bind('timestampawal', $timestampawal);
        $this->db->bind('timestampakhir', $timestampakhir);
        return $this->db->resultSet();
    }
}