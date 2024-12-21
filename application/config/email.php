<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol']    = 'smtp';
$config['smtp_host']   = 'smtp.gmail.com'; // Ganti dengan host SMTP Anda
$config['smtp_port']   = 587; // Ganti dengan port SMTP yang sesuai (587 untuk TLS, 465 untuk SSL)
$config['smtp_user']   = 'renggapriyardana89@gmail.com'; // Ganti dengan email Anda
$config['smtp_pass']   = 'gonh owlf wmzs habq'; // Ganti dengan password email Anda
$config['mailtype']     = 'html'; // atau 'text' untuk email teks biasa
$config['charset']      = 'utf-8';
$config['newline']      = "\r\n";
$config['smtp_crypto']  = 'tls'; // Ganti dengan 'ssl' jika menggunakan SSL
