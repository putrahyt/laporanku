<?php

class Flasher
{
    public static function setFlash($pesan, $type)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'type' => $type
        ];
    }

    public static function pesan()
    {
        if (isset($_SESSION['flash']['pesan'])) {
            echo $_SESSION['flash']['pesan'];
            unset($_SESSION['flash']['pesan']);
        }
    }

    public static function type()
    {
        if (isset($_SESSION['flash']['type'])) {
            echo $_SESSION['flash']['type'];
            unset($_SESSION['flash']['type']);
        }
    }
}
