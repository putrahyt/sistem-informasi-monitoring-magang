<?php

class Logout extends Controller {
    public function index() {
        unset($_SESSION['session']);
        Flasher::setFlash("Anda telah logout", "success");
        header("Location: " . BASEURL);
        exit;
    }
}