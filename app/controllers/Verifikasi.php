<?php

class Verifikasi extends Controller {
    public function __construct()
    {
        if(isset($_SESSION['session'])) {
            header("Location: " . BASEURL . "/" . $_SESSION['session']['role']);
            exit;
        }
    }

    public function index() {
        header("Location: " . BASEURL);
        exit;
    }

    public function verifikasipeserta($token = null) {
        $token_hash = hash("sha256", $token);
        $checkToken = $this->model('Login_model')->getTokenPeserta($token_hash);
        
        if(isset($_POST['resetpass'])) {
            if($checkToken) {
                if ($checkToken['reset_token_expires_at'] <= time()) {
                    Flasher::setFlashLogin("URL telah expired! Masukkan email kembali", "danger");
                    header("Location: " . BASEURL . "/login/forgetpasswordpeserta");
                    exit;
                } else if(strlen($_POST['password1']) < 5) {
                    Flasher::setFlashLogin("Password setidaknya minimal 5 karakter", "danger");
                    header("Location: " . BASEURL . "/verifikasi/verifikasipeserta/" . $token);
                    exit;
                } else if($_POST['password1'] !== $_POST['password2']) {
                    Flasher::setFlashLogin("Password tidak sama!", "danger");
                    header("Location: " . BASEURL . "/verifikasi/verifikasipeserta/" . $token);
                    exit;
                }

                // Ubah Password
                if($this->model("Login_model")->ubahPasswordPeserta($checkToken['username'], $_POST) > 0) {
                    Flasher::setFlashLogin("Password berhasil diubah!", "success");
                    header("Location: " . BASEURL . "/login");
                    exit;
                } else {
                    Flasher::setFlashLogin("Password gagal diubah!", "success");
                    header("Location: " . BASEURL . "/verifikasi/verifikasipeserta/" . $token);
                    exit;
                }
            }
        }

        if(!$checkToken) {
            header("Location: " . BASEURL);
            exit;
        } else if($checkToken['reset_token_expires_at'] <= time()) {
            Flasher::setFlashLogin("URL telah expired! Masukkan email kembali", "danger");
            header("Location: " . BASEURL . "/login/forgetpasswordpeserta");
            exit;
        }

        $data['token'] = $token;
        $data['judul'] = "Reset Password Peserta";
        $this->view('templates/auth_header', $data);
        $this->view('login/resetpasswordpeserta', $data);
        $this->view('templates/auth_footer');
    }

    public function verifikasimentor($token = null) {
        $token_hash = hash("sha256", $token);
        $checkToken = $this->model('Login_model')->getTokenMentor($token_hash);
        
        if(isset($_POST['resetpass'])) {
            if($checkToken) {
                if ($checkToken['reset_token_expires_at'] <= time()) {
                    Flasher::setFlashLogin("URL telah expired! Masukkan email kembali", "danger");
                    header("Location: " . BASEURL . "/login/forgetpasswordmentor");
                    exit;
                } else if(strlen($_POST['password1']) < 5) {
                    Flasher::setFlashLogin("Password setidaknya minimal 5 karakter", "danger");
                    header("Location: " . BASEURL . "/verifikasi/verifikasimentor/" . $token);
                    exit;
                } else if($_POST['password1'] !== $_POST['password2']) {
                    Flasher::setFlashLogin("Password tidak sama!", "danger");
                    header("Location: " . BASEURL . "/verifikasi/verifikasimentor/" . $token);
                    exit;
                }

                // Ubah Password
                if($this->model("Login_model")->ubahPasswordMentor($checkToken['username'], $_POST) > 0) {
                    Flasher::setFlashLogin("Password berhasil diubah!", "success");
                    header("Location: " . BASEURL . "/login/mentor");
                    exit;
                } else {
                    Flasher::setFlashLogin("Password gagal diubah!", "success");
                    header("Location: " . BASEURL . "/verifikasi/verifikasimentor/" . $token);
                    exit;
                }
            }
        }

        if(!$checkToken) {
            header("Location: " . BASEURL);
            exit;
        } else if($checkToken['reset_token_expires_at'] <= time()) {
            Flasher::setFlashLogin("URL telah expired! Masukkan email kembali", "danger");
            header("Location: " . BASEURL . "/login/forgetpasswordmentor");
            exit;
        }

        $data['token'] = $token;
        $data['judul'] = "Reset Password Mentor";
        $this->view('templates/auth_header', $data);
        $this->view('login/resetpasswordmentor', $data);
        $this->view('templates/auth_footer');
    }

    public function verifikasiadmin($token = null) {
        $token_hash = hash("sha256", $token);
        $checkToken = $this->model('Login_model')->getTokenAdmin($token_hash);
        
        if(isset($_POST['resetpass'])) {
            if($checkToken) {
                if ($checkToken['reset_token_expires_at'] <= time()) {
                    Flasher::setFlashLogin("URL telah expired! Masukkan email kembali", "danger");
                    header("Location: " . BASEURL . "/login/forgetpasswordadmin");
                    exit;
                } else if(strlen($_POST['password1']) < 5) {
                    Flasher::setFlashLogin("Password setidaknya minimal 5 karakter", "danger");
                    header("Location: " . BASEURL . "/verifikasi/verifikasiadmin/" . $token);
                    exit;
                } else if($_POST['password1'] !== $_POST['password2']) {
                    Flasher::setFlashLogin("Password tidak sama!", "danger");
                    header("Location: " . BASEURL . "/verifikasi/verifikasiadmin/" . $token);
                    exit;
                }

                // Ubah Password
                if($this->model("Login_model")->ubahPasswordAdmin($checkToken['username'], $_POST) > 0) {
                    Flasher::setFlashLogin("Password berhasil diubah!", "success");
                    header("Location: " . BASEURL . "/login/admin");
                    exit;
                } else {
                    Flasher::setFlashLogin("Password gagal diubah!", "success");
                    header("Location: " . BASEURL . "/verifikasi/verifikasiadmin/" . $token);
                    exit;
                }
            }
        }

        if(!$checkToken) {
            header("Location: " . BASEURL);
            exit;
        } else if($checkToken['reset_token_expires_at'] <= time()) {
            Flasher::setFlashLogin("URL telah expired! Masukkan email kembali", "danger");
            header("Location: " . BASEURL . "/login/forgetpasswordadmin");
            exit;
        }

        $data['token'] = $token;
        $data['judul'] = "Reset Password Mentor";
        $this->view('templates/auth_header', $data);
        $this->view('login/resetpasswordadmin', $data);
        $this->view('templates/auth_footer');
    }

}