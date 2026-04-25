<?php
date_default_timezone_set('Asia/Jakarta');

class Login extends Controller {
    public function __construct()
    {
        if(isset($_SESSION['session'])) {
            header("Location: " . BASEURL . "/" . $_SESSION['session']['role']);
            exit;
        }
    }

    public function index()
    {
        if(isset($_POST['login'])) {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $checkEmail = $this->model('Login_model')->getEmailPeserta($email);

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Flasher::setFlashLogin("Invalid email format", "danger");
                header("Location: " . BASEURL . "/login");
                exit;
            }
            
            if(!empty($checkEmail)) {
                if(password_verify($password, $checkEmail['password'])) {
                    $_SESSION['session'] = [
                        'username' => $checkEmail['username'],
                        'role' => $checkEmail['role']
                    ];

                    header("Location: " . BASEURL . "/peserta");
                    exit;
                } else {
                    Flasher::setFlashLogin("Password anda salah!", "danger");
                    header("Location: " . BASEURL . "/login");
                    exit;
                }
            } else {
                Flasher::setFlashLogin("Email tidak ada!", "danger");
                header("Location: " . BASEURL . "/login");
                exit;
            }
        }

        $data['judul'] = "Login Peserta";
        $this->view('templates/auth_header', $data);
        $this->view('login/peserta');
        $this->view('templates/auth_footer');
    }
    
    public function mentor()
    {
        if(isset($_POST['login'])) {
            $username = strtolower($_POST['username']);
            $password = $_POST['password'];

            $checkUsername = $this->model('Login_model')->getUsernameMentor($username);

            if($checkUsername) {
                if(password_verify($password, $checkUsername['password'])) {
                    $_SESSION['session'] = [
                        'username' => $checkUsername['username'],
                        'role' => $checkUsername['role']
                    ];

                    header("Location: " . BASEURL . "/mentor");
                    exit;
                } else {
                    Flasher::setFlashLogin("Password anda salah!", "danger");
                    header("Location: " . BASEURL . "/login/mentor");
                    exit;
                }
            } else {
                Flasher::setFlashLogin("Username tidak ada!", "danger");
                header("Location: " . BASEURL . "/login/mentor");
                exit;
            }
        }

        $data['judul'] = "Login Mentor";
        $this->view('templates/auth_header', $data);
        $this->view('login/mentor');
        $this->view('templates/auth_footer');
    }

    public function admin()
    {
        if(isset($_POST['login'])) {
            $username = strtolower($_POST['username']);
            $password = $_POST['password'];

            $checkUsername = $this->model('Login_model')->getUsernameAdmin($username);

            if($checkUsername) {
                if(password_verify($password, $checkUsername['password'])) {
                    $_SESSION['session'] = [
                        'username' => $checkUsername['username'],
                        'role' => $checkUsername['role']
                    ];

                    header("Location: " . BASEURL . "/admin");
                    exit;
                } else {
                    Flasher::setFlashLogin("Password anda salah!", "danger");
                    header("Location: " . BASEURL . "/login/admin");
                    exit;
                }
            } else {
                Flasher::setFlashLogin("Username tidak ada!", "danger");
                header("Location: " . BASEURL . "/login/admin");
                exit;
            }
        }

        $data['judul'] = "Login Admin";
        $this->view('templates/auth_header', $data);
        $this->view('login/admin');
        $this->view('templates/auth_footer');
    }

    public function tamu()
    {
        $_SESSION['session'] = ['role' => 'tamu', 'username' => 'tamu'];
        header("Location: " . BASEURL . "/tamu");
        exit;
    }

    public function registrasipeserta()
    {
        if(isset($_POST['registrasi'])) {

            // Validasi Peserta
            $checkUsername = $this->model('Login_model')->getUsernamePeserta($_POST['username']);
            $checkEmail = $this->model('Login_model')->getEmailPeserta(trim($_POST['email']));
            if($checkUsername) {
                Flasher::setFlashLogin("Username tersebut sudah digunakan", "danger");
                header("Location: " . BASEURL . "/login/registrasipeserta");
                exit;
            } else if($checkEmail) {
                Flasher::setFlashLogin("Email tersebut sudah digunakan", "danger");
                header("Location: " . BASEURL . "/login/registrasipeserta");
                exit;
            } else if(strlen($_POST['password']) < 5) {
                Flasher::setFlashLogin("Password setidaknya minimal 5 karakter", "danger");
                header("Location: " . BASEURL . "/login/registrasipeserta");
                exit;
            } else if(!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
                Flasher::setFlashLogin("Invalid email format", "danger");
                header("Location: " . BASEURL . "/login/registrasipeserta");
                exit;
            } 

            // Tambah Peserta
            if($this->model('Login_model')->addPeserta($_POST) > 0) {
                Flasher::setFlashLogin("Berhasil membuat akun, silahkan kembali ke halaman login", "success");
                header("Location: " . BASEURL . "/login/registrasipeserta");
                exit;
            } else {
                Flasher::setFlashLogin("Gagal registrasi", "danger");
                header("Location: " . BASEURL . "/login/registrasipeserta");
                exit;
            }
        } 
        
        $data['mentor'] = $this->model('Admin_model')->getAllMentor();
        $data['judul'] = "Registrasi Peserta";
        $this->view('templates/auth_header', $data);
        $this->view('login/registrasipeserta', $data);
        $this->view('templates/auth_footer');
    }

    public function forgetpasswordpeserta()
    {
        if(isset($_POST['reset'])) {
            $checkEmail = $this->model('Login_model')->getEmailPeserta(trim($_POST['email']));
            if($checkEmail) {
                $token = bin2hex(random_bytes(16));
                $token_hash = hash("sha256", $token);
                $token_expires = time() + (60*5);
                $url = BASEURL . "/verifikasi/verifikasipeserta/" . $token;

                $data = [$token_hash, $token_expires, $checkEmail['email']];

                if($this->model('Login_model')->updateTokenPeserta($data) > 0) {
                    $mail = Mailer::sendEmail();

                    $mail->setFrom("appmagangku@gmail.com", "MAGANGKU");
                    $mail->addReplyTo("no-reply@example.com", "MAGANGKU");
                    $mail->addAddress($checkEmail['email'], $checkEmail['fullname_peserta']);
                    $mail->Subject = "Password Reset";
                    $mail->isHTML(true);
                    $mail->Body = '<h2>Reset Password MAGANGKU</h2>
                        <p>Untuk mengatur ulang password, silahkan klik link dibawah ini!</p>
                        <a href="'.$url.'">[Klik Disini]</a>
                        <p>atau salin link url dibawah ini</p>
                        <b>'.$url.'</b>';

                    try {
                        $mail->send();
                        Flasher::setFlashLogin("Pesan terkirim, check di kotak masuk email kamu atau di folder spam!", "success");
                        header("Location: " . BASEURL . "/login/forgetpasswordpeserta");
                        exit;
                    } catch(Exception $e) {
                        echo "Message could not be sent. Mailer error: '. {$mail->ErrorInfo}.'";
                    }
                    
                }
            } else {
                Flasher::setFlashLogin("Email tidak ada!", "danger");
                header("Location: " . BASEURL . "/login/forgetpasswordpeserta");
                exit;
            }
        }

        $data['judul'] = "Lupa Password - Peserta";
        $this->view('templates/auth_header', $data);
        $this->view('login/lupapasswordpeserta');
        $this->view('templates/auth_footer');
    }

    public function forgetpasswordmentor() 
    {
        if(isset($_POST['reset'])) {
            $checkEmail = $this->model('Login_model')->getEmailMentor(trim($_POST['email']));
            if($checkEmail) {
                $token = bin2hex(random_bytes(16));
                $token_hash = hash("sha256", $token);
                $token_expires = time() + (60*5);
                $url = BASEURL . "/verifikasi/verifikasimentor/" . $token;

                $data = [$token_hash, $token_expires, $checkEmail['email']];

                if($this->model('Login_model')->updateTokenMentor($data) > 0) {
                    $mail = Mailer::sendEmail();

                    $mail->setFrom("appmagangku@gmail.com", "MAGANGKU");
                    $mail->addReplyTo("no-reply@example.com", "MAGANGKU");
                    $mail->addAddress($checkEmail['email'], $checkEmail['fullname']);
                    $mail->Subject = "Password Reset";
                    $mail->isHTML(true);
                    $mail->Body = '<h2>Reset Password MAGANGKU</h2>
                        <p>Untuk mengatur ulang password, silahkan klik link dibawah ini!</p>
                        <a href="'.$url.'">[Klik Disini]</a>
                        <p>atau salin link url dibawah ini</p>
                        <b>'.$url.'</b>';

                    try {
                        $mail->send();
                        Flasher::setFlashLogin("Pesan terkirim, check di kotak masuk email kamu atau di folder spam!", "success");
                        header("Location: " . BASEURL . "/login/forgetpasswordmentor");
                        exit;
                    } catch(Exception $e) {
                        echo "Message could not be sent. Mailer error: '. {$mail->ErrorInfo}.'";
                    }
                    
                }
            } else {
                Flasher::setFlashLogin("Email tidak ada!", "danger");
                header("Location: " . BASEURL . "/login/forgetpasswordmentor");
                exit;
            }
        }

        $data['judul'] = "Lupa Password - Mentor";
        $this->view('templates/auth_header', $data);
        $this->view('login/lupapasswordmentor');
        $this->view('templates/auth_footer');
    }

    public function forgetpasswordadmin() 
    {
        if(isset($_POST['reset'])) {
            $checkEmail = $this->model('Login_model')->getEmailAdmin(trim($_POST['email']));
            if($checkEmail) {
                $token = bin2hex(random_bytes(16));
                $token_hash = hash("sha256", $token);
                $token_expires = time() + (60*5);
                $url = BASEURL . "/verifikasi/verifikasiadmin/" . $token;

                $data = [$token_hash, $token_expires, $checkEmail['email']];

                if($this->model('Login_model')->updateTokenAdmin($data) > 0) {
                    $mail = Mailer::sendEmail();

                    $mail->setFrom("appmagangku@gmail.com", "MAGANGKU");
                    $mail->addReplyTo("no-reply@example.com", "MAGANGKU");
                    $mail->addAddress($checkEmail['email'], $checkEmail['username']);
                    $mail->Subject = "Password Reset";
                    $mail->isHTML(true);
                    $mail->Body = '<h2>Reset Password MAGANGKU</h2>
                        <p>Untuk mengatur ulang password, silahkan klik link dibawah ini!</p>
                        <a href="'.$url.'">[Klik Disini]</a>
                        <p>atau salin link url dibawah ini</p>
                        <b>'.$url.'</b>';

                    try {
                        $mail->send();
                        Flasher::setFlashLogin("Pesan terkirim, check di kotak masuk email kamu atau di folder spam!", "success");
                        header("Location: " . BASEURL . "/login/forgetpasswordadmin");
                        exit;
                    } catch(Exception $e) {
                        echo "Message could not be sent. Mailer error: '. {$mail->ErrorInfo}.'";
                    }
                    
                }
            } else {
                Flasher::setFlashLogin("Email tidak ada!", "danger");
                header("Location: " . BASEURL . "/login/forgetpasswordadmin");
                exit;
            }
        }

        $data['judul'] = "Lupa Password - Mentor";
        $this->view('templates/auth_header', $data);
        $this->view('login/lupapasswordadmin');
        $this->view('templates/auth_footer');
    }

}