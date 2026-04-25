<?php

class Helper {
    public static function is_logged_in()
    {
        if (!$_SESSION['session']) {
            header("Location: " . BASEURL);
        } else {
            $url = explode('/', $_GET['url']);
            if ($url[0] !== $_SESSION['session']['role']) {
                header("Location: " . BASEURL . "/" . $_SESSION['session']['role']);
            }
        }
    }
}