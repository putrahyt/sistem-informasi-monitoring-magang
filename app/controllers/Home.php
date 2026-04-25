<?php

class Home extends Controller {
    public function __construct()
    {   
        if(isset($_SESSION['session'])) {
            header("Location: " . BASEURL . "/" . $_SESSION['session']['role']);
            exit;
        }
    }

    public function index()
    {
        $data['judul'] = "MAGANGKU - Platform Monitoring Peserta Magang Diskominfo Medan";
        $this->view('home/index', $data);
    }
}