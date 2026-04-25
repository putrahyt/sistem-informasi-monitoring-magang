<?php

class Login_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Peserta
    public function getUsernamePeserta($data) {
        $this->db->query("SELECT * FROM peserta WHERE username=:username");
        $this->db->bind('username', $data);
        return $this->db->single();
    }

    public function getEmailPeserta($data) {
        $this->db->query("SELECT * FROM peserta WHERE email=:email");
        $this->db->bind('email', $data);
        return $this->db->single();
    }

    public function addPeserta($data) {
        $query = "INSERT INTO peserta VALUES (NULL, :fullname_peserta, :username, :password, :email, :mentor_magang, :instansi, :divisi_magang, :date_created, :role, :image, :reset_token_hash, :reset_token_expires_at)";
        $this->db->query($query);
        $this->db->bind('fullname_peserta', htmlspecialchars($data['fullname']));
        $this->db->bind('username', strtolower(stripslashes(htmlspecialchars($data['username']))));
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind('email', trim($data['email']));
        $this->db->bind('mentor_magang', $data['mentormagang']);
        $this->db->bind('instansi', htmlspecialchars($data['instansi']));
        $this->db->bind('divisi_magang', $data['divisimagang']);
        $this->db->bind('date_created', time());
        $this->db->bind('role', "peserta");
        $this->db->bind('image', "profile.jpg");
        $this->db->bind('reset_token_hash', null);
        $this->db->bind('reset_token_expires_at', null);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateTokenPeserta($data) {
        $query = "UPDATE peserta SET reset_token_hash=:reset_token_hash, reset_token_expires_at=:reset_token_expires_at WHERE email=:email";
        $this->db->query($query);
        $this->db->bind('reset_token_hash', $data[0]);
        $this->db->bind('reset_token_expires_at', $data[1]);
        $this->db->bind('email', trim($data[2]));
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getTokenPeserta($token) {
        $query = "SELECT * FROM peserta WHERE reset_token_hash=:reset_token_hash";
        $this->db->query($query);
        $this->db->bind('reset_token_hash', $token);
        return $this->db->single();
    }

    public function ubahPasswordPeserta($username, $data) {
        $query = "UPDATE peserta SET password=:password, reset_token_hash=:reset_token_hash, reset_token_expires_at=:reset_token_expires_at WHERE username=:username";
        $this->db->query($query);
        $this->db->bind('reset_token_hash', null);
        $this->db->bind('reset_token_expires_at', null);
        $this->db->bind('password', password_hash($data['password1'], PASSWORD_DEFAULT));
        $this->db->bind('username', $username);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // Admin
    public function getUsernameAdmin($data) {
        $this->db->query("SELECT * FROM admin WHERE username=:username");
        $this->db->bind('username', $data);
        return $this->db->single();
    }

    public function getEmailAdmin($data) {
        $this->db->query("SELECT * FROM admin WHERE email=:email");
        $this->db->bind('email', $data);
        return $this->db->single();
    }

    public function updateTokenAdmin($data) {
        $query = "UPDATE admin SET reset_token_hash=:reset_token_hash, reset_token_expires_at=:reset_token_expires_at WHERE email=:email";
        $this->db->query($query);
        $this->db->bind('reset_token_hash', $data[0]);
        $this->db->bind('reset_token_expires_at', $data[1]);
        $this->db->bind('email', trim($data[2]));
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getTokenAdmin($token) {
        $query = "SELECT * FROM admin WHERE reset_token_hash=:reset_token_hash";
        $this->db->query($query);
        $this->db->bind('reset_token_hash', $token);
        return $this->db->single();
    }

    public function ubahPasswordAdmin($username, $data) {
        $query = "UPDATE admin SET password=:password, reset_token_hash=:reset_token_hash, reset_token_expires_at=:reset_token_expires_at WHERE username=:username";
        $this->db->query($query);
        $this->db->bind('reset_token_hash', null);
        $this->db->bind('reset_token_expires_at', null);
        $this->db->bind('password', password_hash($data['password1'], PASSWORD_DEFAULT));
        $this->db->bind('username', $username);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // Mentor
    public function getUsernameMentor($data) {
        $this->db->query("SELECT * FROM mentor WHERE username=:username");
        $this->db->bind('username', $data);
        return $this->db->single();
    }

    public function getEmailMentor($data) {
        $this->db->query("SELECT * FROM mentor WHERE email=:email");
        $this->db->bind('email', $data);
        return $this->db->single();
    }

    public function updateTokenMentor($data) {
        $query = "UPDATE mentor SET reset_token_hash=:reset_token_hash, reset_token_expires_at=:reset_token_expires_at WHERE email=:email";
        $this->db->query($query);
        $this->db->bind('reset_token_hash', $data[0]);
        $this->db->bind('reset_token_expires_at', $data[1]);
        $this->db->bind('email', trim($data[2]));
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getTokenMentor($token) {
        $query = "SELECT * FROM mentor WHERE reset_token_hash=:reset_token_hash";
        $this->db->query($query);
        $this->db->bind('reset_token_hash', $token);
        return $this->db->single();
    }

    public function ubahPasswordMentor($username, $data) {
        $query = "UPDATE mentor SET password=:password, reset_token_hash=:reset_token_hash, reset_token_expires_at=:reset_token_expires_at WHERE username=:username";
        $this->db->query($query);
        $this->db->bind('reset_token_hash', null);
        $this->db->bind('reset_token_expires_at', null);
        $this->db->bind('password', password_hash($data['password1'], PASSWORD_DEFAULT));
        $this->db->bind('username', $username);
        $this->db->execute();
        return $this->db->rowCount();
    }
}