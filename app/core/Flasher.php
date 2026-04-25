<?php

class Flasher {
    public static function setFlashLogin($pesan, $tipe) {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'tipe' => $tipe
        ];
    }

    public static function flashLogin() {
        if(isset($_SESSION['flash'])) {
            echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show" role="alert">' . $_SESSION['flash']['pesan'] . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            unset($_SESSION['flash']);
        };
    }

    public static function setFlash($pesan, $tipe) {
        $_SESSION['flashmain'] = [
            'pesan' => $pesan,
            'tipe' => $tipe
        ];
    }

    public static function pesan() {
        if(isset($_SESSION['flashmain']['pesan'])) {
            echo $_SESSION['flashmain']['pesan'];
            unset($_SESSION['flashmain']['pesan']);
        }
    }

    public static function tipe() {
        if(isset($_SESSION['flashmain']['tipe'])) {
            echo $_SESSION['flashmain']['tipe'];
            unset($_SESSION['flashmain']['tipe']);
        }
    }


}