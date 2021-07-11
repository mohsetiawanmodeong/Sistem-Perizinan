<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function set_zone()
{
    return date_default_timezone_set("Asia/Jakarta");
}

function tgl_indo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function tgl_simpan($tgl)
{
    $tanggal = substr($tgl, 0, 2);
    $bulan = substr($tgl, 3, 2);
    $tahun = substr($tgl, 6, 4);
    return $tahun . '-' . $bulan . '-' . $tanggal;
}

function tgl_view($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = substr($tgl, 5, 2);
    $tahun = substr($tgl, 0, 4);
    return $tanggal . '-' . $bulan . '-' . $tahun;
}

function tgl_grafik($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . '_' . $bulan;
}

function hari_ini($w)
{
    $seminggu = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
    $hari_ini = $seminggu[$w];
    return $hari_ini;
}

function getBulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

function now()
{
    set_zone();
    return date('Y:m:d H:i:s');
}

function sendWhatsapp($nomor = 0)
{

    $CI = &get_instance();

    date_default_timezone_set('Asia/Jakarta');
    $time  = date("H");
    ($time < "11")                  ? $waktu = "Selamat Pagi"   : NULL;
    ($time >= "11" && $time < "15") ? $waktu = "Selamat Siang"  : NULL;
    ($time >= "15" && $time < "19") ? $waktu = "Selamat Sore"   : NULL;
    ($time >= "19")                 ? $waktu = "Selamat Malam"  : NULL;

    $isi  = $CI->db->where('tipe', 'default')->get('tbl_chatwhatsapp')->row()->isi;
    $chat = 'https://api.whatsapp.com/send?phone=' . $nomor . '&text=' . $waktu . ',%0A' . $isi;

    return $chat;
}

function selisihWaktu($start, $end)
{
    set_zone();
    if ($start == 'now') {
        $start = new DateTime();
    } else {
        $start = new DateTime($start);
    }
    $end = new DateTime($end);
    $diff = date_diff($end, $start);
    if ($diff->y > 0) {
        return $diff->y . ' tahun ';
    } else {
        if ($diff->m > 0) {
            return $diff->m . ' bulan ';
        } else {
            if ($diff->d > 0) {
                return $diff->d . ' hari ';
            } else {
                if ($diff->h > 0) {
                    return $diff->h . ' jam ';
                } else {
                    if ($diff->i > 0) {
                        return $diff->i . ' menit ';
                    } else {
                        if ($diff->s > 0) {
                            return '1 > Menit';
                        } else {
                            return 'Baru Saja';
                        }
                    }
                }
            }
        }
    }
}

function selisihTahun($start, $end)
{
    set_zone();
    if ($start == 'now') {
        $start = new DateTime();
    } else {
        $start = new DateTime($start);
    }
    $end = new DateTime($end);
    $diff = date_diff($end, $start);
    if ($diff->y > 0) {
        return $diff->y;
    } else {
        return 1;
    }
}

// Send Email
function kirimEmail($isi)
{
    // Panggil Library PHPMailer
    require APPPATH.'libraries\phpmailer\src\Exception.php';
    require APPPATH.'libraries\phpmailer\src\PHPMailer.php';
    require APPPATH.'libraries\phpmailer\src\SMTP.php';
        
    $response           = false;
    $mail               = new PHPMailer();

    $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
            );

    // Cek Data
    $data       =
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host         = 'smtp.googlemail.com'; //sesuaikan sesuai nama domain hosting/server yang digunakan
    $mail->SMTPAuth     = true;
    $mail->Username     = 'djawikita@gmail.com'; // user email
    $mail->Password     = 'qnianbiihyqlqcmi'; // password email
    $mail->SMTPSecure   = 'ssl';
    $mail->Port         = 465;
    $mail->setFrom('djawikita@gmail.com', 'no-reply'); // user email
    $mail->addReplyTo('djawilab@gmail.com', 'no-reply'); //user email

    // Add a recipient
    $mail->addAddress($isi['email']); //email tujuan pengiriman email

    // Email subject
    $mail->Subject = $isi['title']  ; //subject email

    // Set email format to HTML
    $mail->isHTML(true);

    // Isi Content
    $mailContent =
            '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <meta name="description" content="">
                <meta name="author" content="">
            </head>
            <body id="page-top">
                <!-- Page Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">
                    <!-- Main Content -->
                    <div id="content">
                        <div class="row">
                            <div class="col-sm-12">
                                </br>
                                <h1 class="text-center">'.$isi['title'].'</h1>
                                <br>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            Berikut Data Username dan Password Anda : </br>
                                            <label>Username : '.$isi['username'].'</label>
                                            </br>
                                            <label>Password : '.$isi['password'].'</label>
                                            </br>
                                            </br>
                                            Note : Segera Lakukan Penggantian Password Untuk Keamanan Akun Anda.
                                        </div>
                                    </div>
                                </div>
                                </br>
                            </div>
                        </div>
                    </div>
                </body>
            </html>';
    $mail->Body = $mailContent;

    // Send email
    if (!$mail->send()) {
    } else {
    }
}